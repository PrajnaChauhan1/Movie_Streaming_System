# 🎬 Movie Streaming System (MSS)

The **Movie Streaming System (MSS)** is a full-featured web-based application that allows users to search and stream movies directly from their browser, eliminating the need for physical media or third-party software. Built to offer a smooth and enjoyable streaming experience, MSS also empowers content creators and distributors to reach a larger audience and manage their media catalog with ease.

---

## 🌐 Live Preview

> ⚠️ *This is a local PHP-based project. No live deployment is provided.*

---

## 📌 Features

- 🔍 **Search & Stream**: Instantly search movies by name and stream with one click.
- 🧑‍💻 **User Authentication**: Register and log in to access the movie library.
- 🧾 **Write & View Reviews**: Share your thoughts after watching, and read others’ reviews.
- 🎬 **Admin Panel**:
  - Upload movies
  - Edit and delete movie entries
  - View uploaded content
- ⚡ **Responsive UI**: Clean and user-friendly interface for seamless usage.

---

## 🔧 Tech Stack

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Streaming**: Server-based video streaming using native browser capabilities

---

## 🧪 Testing Process

Testing was divided into **Unit Testing** and **System Testing** to ensure complete functionality and reliability across user and admin modules.

---

### ✅ Unit Test Cases

| Test ID | Scenario                    | Input                                    | Expected Output                     | Result |
|---------|-----------------------------|------------------------------------------|-------------------------------------|--------|
| T01     | Admin Login (Valid)         | `pragya@gmail.com / Pragya@123`          | Admin dashboard                     | Pass   |
| T02     | Admin Login (Invalid)       | `pragyaa@gmail.com / user@123`           | Error: Invalid Details              | Pass   |
| T03     | User Login (Valid)          | `xyz@gmail.com / xyz@123`          | Redirect to user homepage           | Pass   |
| T04     | User Login (Invalid)        | `xyz132@gmail / hehe@123`             | Error: Invalid Details              | Pass   |
| T05     | Empty Fields on Login       | No input                                 | Error: Enter username and password  | Pass   |

---

### 🔎 System Test Cases

| Test ID | Scenario                            | Input Summary                            | Expected Output                           | Result |
|--------|-------------------------------------|------------------------------------------|-------------------------------------------|--------|
| S01    | Valid User Registration             | Valid inputs                              | Redirect to login                         | Pass   |
| S02    | Invalid Registration                | Mismatched password, bad email, etc.      | Show validation errors                     | Fail   |
| S03    | Login with correct credentials      | `pragya@gmail.com / pp@#12345`            | Login success                             | Pass   |
| S04    | Login with incorrect credentials    | `test@gmail.com / test1`                  | Error: password too short                 | Fail   |
| S05    | Upload Movie (Admin)                | Valid details                             | Movie uploaded successfully               | Pass   |
| S06    | Edit Movie Details (Admin)          | Updated valid movie data                  | Edited successfully                        | Pass   |
| S07    | Search Movie (Admin)                | `Phir Hera Pheri`                         | Search result found                        | Pass   |
| S08    | Search Movie (User)                 | `Phir Hera Pheri`                         | Search result found                        | Pass   |
| S09    | Search Random Movie (Admin)         | `aaaa`                                    | No results found                           | Fail   |
| S10    | Search Random Movie (User)          | `KKKKKK`                                  | No results found                           | Fail   |
| S11    | Review Submission (User)            | "The movie was really funny."             | Review posted                              | Pass   |
| S12    | Duplicate Review (User)             | "I love this movie."                      | Already reviewed warning                   | Fail   |

---

## 🔐 Roles

### 👤 User
- Register, Login
- Browse, Search & Stream movies
- Submit movie reviews
- Read reviews from others

### 🛠️ Admin
- Login securely
- Upload movies (video, thumbnail, metadata)
- Edit or delete existing entries
- Preview uploaded content
- Manage user reviews

---

## 🧱 System Architecture

- **MVC structure**: Decouples logic from views
- **Secure Login**: Simple hashed password mechanism
- **Database schema**:
  - `users`: User credentials and metadata
  - `movies`: Movie title, description, file paths, release info
  - `reviews`: User-submitted feedback
  - `admins`: Admin credentials

---