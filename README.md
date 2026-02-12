# e-quipmen-backend

Backend aplikasi manajemen peralatan (e-quipmen-backend).

## Fitur

- Manajemen data peralatan
- CRUD peralatan
- Autentikasi pengguna
- REST API
- Integrasi database

## Instalasi

1. Clone repo:
    ```bash
    git clone https://github.com/username/e-quipmen-backend.git
    ```
2. Masuk folder project:
    ```bash
    cd e-quipmen-backend
    ```
3. Install dependencies:
    ```bash
    npm install
    ```

## Menjalankan Aplikasi

Jalankan server:

```bash
npm start
```

## Konfigurasi

Edit file `.env` untuk konfigurasi database dan environment.

## Endpoint API

- `/api/equipment` - CRUD peralatan
- `/api/auth` - Autentikasi

## Struktur Folder

```
e-quipmen-backend/
├── src/
│   ├── controllers/
│   ├── models/
│   ├── routes/
│   ├── services/
│   └── utils/
├── .env
├── package.json
├── README.md
└── node_modules/
```

## Kontribusi

Pull request dan issue dipersilakan.

## Lisensi

MIT License
