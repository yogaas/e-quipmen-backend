<?php

        namespace App\Http\Resources;
        
        use Illuminate\Http\Request;
        use Illuminate\Http\Resources\Json\JsonResource;
        
        class AccountResource extends JsonResource
        {
            public function toArray(Request $request): array
            {
                return [
					'id'                => $this->id, 
					'id_parent'                => $this->id_parent, 
					'code_account'                => $this->code_account, 
					'name_account'                => $this->name_account, 
					'level'                => $this->level, 
					'header'                => $this->header, 
					'normal_pos'                => $this->normal_pos, 
					'grouper'                => $this->grouper, 
                ];
            }
        }