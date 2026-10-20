# Thesis Management System
An admin dashboard for managing the thesis (*skripsi*) process at a university: student and lecturer records, thesis registration, supervision sessions, exam scheduling, exam rooms, progress tracking, and final grades.

Final project (UAS) for the **Web Development** course, Information Systems, Tarumanagara University, academic year 2025–2026.

![Dashboard](docs/screenshots/dashboard.png)

## Features
- **Login with session-based access.** Management pages redirect to the login page when there is no active session. Logout ends the session.
- **Full CRUD (Create, Read, Update, Delete) for 9 modules:** Students, Lecturers, Academic Advisors, Thesis Participants, Supervision Sessions, Thesis Exams, Exam Rooms, Thesis Progress, and Thesis Grades.
- **Search by student ID (NPM)** on the list pages.
- **Relational data handling.** Form dropdowns are filled from related tables (for example, student NPM from the students table, lecturer NIDN from the lecturers table, rooms from the exam rooms table). List pages join several tables, such as the exam schedule with the supervisor and room.
- **File uploads:** supervision documents (PDF), exam photos (JPG), and thesis participant documents (JPG/PNG), with file type and size checks.
- **Sidebar navigation** adapted from the SB Admin template so every form is reachable from the dashboard menu.

## Screenshots
| Login | Student list |
|---|---|
| ![Login](docs/screenshots/login.png) | ![Students](docs/screenshots/students.png) |

| Add exam schedule | Exam list with photos |
|---|---|
| ![Exam form](docs/screenshots/exam-form.png) | ![Exam list](docs/screenshots/exam-list.png) |

## Database
MySQL database named `tugasakhir` with 10 tables:
| Table | Purpose | Main columns |
|---|---|---|
| `mahasiswa` | Student records | `mhs_NPM`, `mhs_Nama`, `mhs_Alamat`, `mhs_DOB`, `mhs_Ket` |
| `dosen` | Lecturer records | `dosen_NIDN`, `dosen_NIK`, `dosen_Nama`, `dosen_Ket` |
| `penasihat` | Academic advisor assignment (student ↔ lecturer) | `mhs_NPM`, `dosen_NIDN`, `penasihat_FILE`, `penasihat_Ket` |
| `pesertaskripsi` | Thesis registration | `mhs_NPM`, semester, academic year, registration date, title, document, `dosen_NIDN` |
| `bimbinganskripsi` | Supervision sessions | `dosen_NIDN`, `mhs_NPM`, date, notes, document (PDF) |
| `ujianskripsi` | Exam schedule | `mhs_NPM`, `id_ruang`, date, time, photo |
| `ruangujian` | Exam rooms | `id_ruang`, `nama_ruang`, location, capacity |
| `progresskripsi` | Thesis progress | `id_progres`, `mhs_NPM`, `dosen_NIDN`, summary, status |
| `nilaiskripsi` | Final grades | `id_nilai`, `mhs_NPM`, grade, notes |
| `admin` | Admin accounts | `admin_USER`, `admin_PASS` |

`penasihat`, `bimbinganskripsi`, and `progresskripsi` are link tables that connect students and lecturers.

## Tech Stack
- PHP (procedural, `mysqli`)
- MySQL
- Bootstrap 5 and the [SB Admin](https://github.com/StartBootstrap/startbootstrap-sb-admin) template by Start Bootstrap, customized
- HTML, CSS, JavaScript, jQuery, Select2, Bootstrap Icons
- XAMPP for local development

## Getting Started
1. Install [XAMPP](https://www.apachefriends.org) and start **Apache** and **MySQL**.
2. Copy the `admin` folder of this repository into `C:\xampp\htdocs\`.
3. Open phpMyAdmin (`http://localhost/phpmyadmin`), create a database named `tugasakhir`, and import `database/tugasakhir.sql`.
4. Check `includes/config.php`. The defaults match a fresh XAMPP install (`localhost`, user `root`, empty password, database `tugasakhir`).
5. Open `http://localhost/admin/login.php` and sign in with the demo account: `[demo email]` / `[demo password]`.

## Project Structure
```
admin/
├── bagiankode/      # reusable layout parts (head, top nav, sidebar, footer, scripts)
├── css/ js/         # Bootstrap and template assets
├── includes/        # database connection (config.php)
├── images/          # default image and uploaded thesis documents
├── foto/            # uploaded exam photos
├── input*.php       # list + create pages for each module
├── edit*.php        # update pages
├── hapus*.php       # delete handlers
├── login.php / logout.php
└── dashboard.php
```

## Known Limitations and Planned Improvements
This project was built for learning and runs on a local server only. I am aware of the following issues and plan to fix them:
- **SQL queries are built by concatenating user input.** Next step: switch to `mysqli` prepared statements.
- **Admin passwords are stored and compared in plain text.** Next step: use `password_hash()` and `password_verify()`.
- **Delete handlers (`hapus*.php`) do not check the session and use GET requests.** Next step: add a session check and use POST with confirmation.
- **Redirects after the session check do not call `exit`.** Next step: stop script execution after redirecting.
- **Upload validation checks the file extension only,** and rejected uploads give no error message. Next step: check MIME type, rename files, and show feedback.
- **Template leftovers** (Charts, Tables, Authentication pages in the sidebar) are not connected to the thesis data.
- Some pages exist in two versions (for example `inputpesertaskripsi.php` and `inputpesertaskripsi-search.php`). The menu uses the `-search` versions.

## Credits and Notes
- Admin template: [SB Admin](https://github.com/StartBootstrap/startbootstrap-sb-admin) by Start Bootstrap (MIT License).
- All records in the sample database are fictional.
- This repository is shared for portfolio and learning purposes. Please do not submit it as your own coursework.

## Author
**Tracy Prycillia Kusmana**
