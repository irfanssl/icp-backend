#### Backend Technical Test 

<br>

##### SOAL 1 : 
Terdapat 2 tabel: `loyalty_points` dan `point_transactions`. 
- Tabel `loyalty_points` menyimpan saldo poin per customer per batch: 
  - `id` 
  - `customer_id` 
  - `batch_code` (misal: "PROMO_JAN_2025")
  - `expired_date` 
  - `initial_point` (jumlah poin awal yang diberikan untuk batch tersebut) 
- Tabel `point_transactions` menyimpan transaksi pemakaian poin dari tiap batch: 
  - `id` 
  - `loyalty_point_id` (FK ke `loyalty_points.id`) 
  - `used_point` (jumlah poin yang dipakai) 
  - `created_at` 
  
Aturan bisnis: 
  - Setiap baris di `loyalty_points` menyimpan poin awal suatu batch, misal 1000 poin. 
  - Total poin yang masih tersisa dalam satu batch = `initial_point` – total `used_point` pada transaksi yang terkait. 
  - Poin tidak bisa digunakan jika `expired_date` sudah lewat (kurang dari tanggal hari 
ini). 

Tugas Soal 1: 
(A) Buat query SQL untuk menampilkan daftar batch poin per customer yang masih bisa 
digunakan, dengan ketentuan: 
1. Hanya ambil batch yang belum expired (`expired_date` >= hari ini). 
2. Hitung dan tampilkan sisa poin dari tiap batch (`remaining_point = initial_point - 
total used_point`). 
1. Hanya tampilkan batch yang masih punya sisa poin > 0. 
2. Urutkan hasil berdasarkan `expired_date` paling dekat, lalu `customer_id`. 

Kolom minimal yang ditampilkan: 
- `customer_id` 
- `batch_code` 
- `expired_date`
- `remaining_point` 

(B) Buat kode Laravel (Query Builder atau Eloquent) yang menghasilkan data dengan 
kriteria yang sama seperti di poin (A).

<br>
<br>

##### SOAL 2 : 
Ada 2 tabel: `tickets` dan `ticket_assignments`: 
- `tickets` 
  - `id` 
  - `customer_id` 
  - `subject` 
  - `status` (contoh: 'OPEN', 'IN_PROGRESS', 'SOLVED', 'CLOSED') 
- `ticket_assignments` 
  - `id` 
  - `ticket_id` 
  - `agent_id` 
  - `assigned_at` 
  - `unassigned_at` (boleh NULL jika masih aktif di agent tersebut) 

Aturan: 
- Satu tiket bisa beberapa kali pindah agent. 
- Hanya assignment dengan `unassigned_at IS NULL` yang dianggap masih aktif pada agent tersebut. 
- Ticket dianggap aktif jika status-nya BUKAN 'SOLVED' dan BUKAN 'CLOSED'. 

Tugas Soal 2: 
(A) Buat query SQL untuk menampilkan jumlah tiket aktif per agent, dengan ketentuan: 
1. Hanya hitung tiket yang: 
   - `status` bukan 'SOLVED' dan bukan 'CLOSED', 
   - Memiliki baris assignment dengan `unassigned_at IS NULL`. 
2. Tampilkan: 
    - `agent_id` 
    - `active_ticket_count` 
3. Urutkan berdasarkan `active_ticket_count` dari terbesar ke terkecil. 

(B) Buat kode Laravel (Query Builder atau Eloquent) untuk menghasilkan data yang 
sama seperti di poin (A). 

<br>
<br>

##### SOAL 3 : 
Ada 2 tabel, `vouchers` dan `voucher_details`. 
   - Tabel vouchers berisi informasi expired date dan level voucher. 
Level pada tabel vouchers mengindikasikan berapa voucher yang diterima customer tersebut. 
Level 1 memiliki 3 jenis voucher dengan nominal 1000, 2000, dan 3000. 
Level 2 memiliki 2 jenis voucher dengan nominal 4000 dan 5000.

- Tabel voucher_details berisi voucher yang sudah diklaim sesuai nominalnya. 

Tugas Soal 3: 
Dari 2 tabel tersebut tampilkan data vouchers dengan keterangan voucher_details yang 
belum di klaim, diurutkan berdasarkan expired date paling dekat dan belum expired.  
Nominal yang ditampilkan adalah nominal paling kecil dari jenis nominal di level yang 
ada. 
Jika 1 customer memiliki lebih dari 1 voucher, maka ditampilkan dari voucher yang 
masih memiliki voucher_details. 