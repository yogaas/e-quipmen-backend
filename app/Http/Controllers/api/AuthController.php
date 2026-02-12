<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\RefreshToken;
use App\Traits\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(Request $request)
    {
        return $this->handleException(function () use ($request) {
            $user = User::where('email', $request->email)->firstOrFail();

            if (!Hash::check($request->password, $user->password)) {
                abort(401, 'Invalid credentials');
            }
        
            // Access Token (pendek)
            $accessToken = $user->createToken(
                name: 'access-token',
                abilities: ['*'],
                expiresAt: now()->addMinutes(120)
            );
        
            // Refresh Token (panjang)
            $refreshToken = Str::random(64);
        
            RefreshToken::create([
                'user_id' => $user->id,
                'token' => hash('sha256', $refreshToken),
                'expires_at' => now()->addDays(7),
            ]);
        
            $data = [
                'user' => $user,
                'access_token' => $accessToken->plainTextToken,
                'refresh_token' => $refreshToken,
                'expires_in' => 900
            ];

            return $this->success(
                $data,
                'Login success',
                200
            );
        });
    }

    public function logout(Request $request)
    {
        return $this->handleException(function () use ($request) {

            $request->user()->currentAccessToken()->delete();

            return $this->success(
                null,
                'Logout success',
                200
            );
            
        });
    }

    public function refresh(Request $request)
    {
        return $this->handleException(function () use ($request) {

            $hashedToken = hash('sha256', $request->refresh_token);

            $refreshToken = RefreshToken::where('token', $hashedToken)
                ->whereNull('revoked_at')
                ->where('expires_at', '>', now())
                ->first();

            if (!$refreshToken) {
                return response()->json([
                    'message' => 'Invalid refresh token'
                ], 401);
            }

            $user = $refreshToken->user;

            // ROTATE refresh token (penting!)
            $refreshToken->update([
                'revoked_at' => now()
            ]);

            $newRefreshToken = Str::random(64);

            RefreshToken::create([
                'user_id' => $user->id,
                'token' => hash('sha256', $newRefreshToken),
                'expires_at' => now()->addDays(7),
            ]);

            // Delete old access tokens
            $user->tokens()->delete();

            // New access token
            $accessToken = $user->createToken(
                'access-token',
                ['*'],
                now()->addMinutes(15)
            );

            $data = [
                'access_token' => $accessToken->plainTextToken,
                'refresh_token' => $newRefreshToken,
                'expires_in' => 900
            ];

            return $this->success(
                $data,
                'Refresh success',
                200
            );
        });
    }
    
    public function me(Request $request)
    {
        return $this->handleException(function () use ($request) {

            return $this->success(
                $request->user(),
                'User login',
                200
            );
            
        });
    }
}
