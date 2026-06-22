# Panduan Deploy ke Railway.app

## Langkah 1: Buat Akun Railway
1. Kunjungi https://railway.app
2. Sign up dengan GitHub account
3. Authorize Railway untuk akses repo GitHub

## Langkah 2: Buat Project Baru
1. Klik "New Project"
2. Pilih "Deploy from GitHub repo"
3. Pilih repo: `heriapras5/rdrinterior`
4. Railway akan otomatis detect Laravel dan mulai build

## Langkah 3: Tambah MySQL Database
1. Di Railway dashboard, klik "New"
2. Pilih "Database" → "Add MySQL"
3. Database akan otomatis dibuat dengan credentials

## Langkah 4: Set Environment Variables
Di Railway dashboard, masuk ke service Laravel Anda, lalu ke tab "Variables", tambahkan:

### Required Variables:
```
APP_NAME=RDR Interior Aluminium
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:XXXXXXXX
APP_URL=${{RAILWAY_PUBLIC_DOMAIN}}

DB_CONNECTION=mysql
DB_HOST=${{MYSQL_HOST}}
DB_PORT=${{MYSQL_PORT}}
DB_DATABASE=${{MYSQL_DATABASE}}
DB_USERNAME=${{MYSQL_USER}}
DB_PASSWORD=${{MYSQL_PASSWORD}}

SESSION_DRIVER=cookie
CACHE_STORE=array
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=local
```

### Generate APP_KEY:
Jalankan di local:
```bash
php artisan key:generate --show
```
Copy hasilnya dan paste ke Railway variable `APP_KEY`

**CATATAN**: Variable `${{MYSQL_*}}` akan otomatis di-inject oleh Railway dari MySQL service.

## Langkah 5: Connect MySQL ke Laravel Service
1. Di Railway dashboard, klik MySQL database
2. Klik tab "Connect"
3. Drag line dari MySQL ke Laravel service
4. Variables akan otomatis ter-link

## Langkah 6: Generate Public Domain
1. Klik service Laravel Anda
2. Ke tab "Settings"
3. Scroll ke "Networking"
4. Klik "Generate Domain"
5. Copy domain yang digenerate (misal: `rdrinterior-production.up.railway.app`)
6. Update variable `APP_URL` dengan domain tersebut

## Langkah 7: Deploy
1. Setiap push ke GitHub akan auto-deploy
2. Atau klik "Deploy" manual di Railway dashboard
3. Tunggu build selesai (5-10 menit pertama kali)
4. Cek logs untuk memastikan tidak ada error

## Troubleshooting

### Error: "No application encryption key"
- Generate APP_KEY dengan `php artisan key:generate --show`
- Set di Railway variables

### Error: Database connection failed
- Pastikan MySQL service sudah connected ke Laravel service
- Check variables DB_* sudah benar

### Error: 500 Internal Server Error
- Cek logs di Railway dashboard
- Pastikan `APP_DEBUG=false` dan `APP_ENV=production`
- Jalankan `php artisan config:clear` di local lalu commit

### Build gagal saat npm run build
- Pastikan semua dependencies di package.json benar
- Check node version compatibility

## Monitoring
- Railway free tier: 500 jam/bulan + $5 credit trial
- Monitoring usage di Railway dashboard
- Logs real-time available di tab "Logs"

## Update Aplikasi
1. Commit perubahan di local
2. Push ke GitHub: `git push origin main`
3. Railway akan auto-deploy perubahan

## Storage untuk File Upload
Railway menggunakan ephemeral filesystem. Untuk file uploads production:
1. Gunakan AWS S3, Cloudinary, atau ImageKit
2. Update `FILESYSTEM_DISK=s3` di variables
3. Set AWS credentials di variables

---

## Kontak Support
- Railway Docs: https://docs.railway.app
- Railway Discord: https://discord.gg/railway
