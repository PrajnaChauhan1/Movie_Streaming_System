# 🎬 Movie Streaming System (MSS)

The **Movie Streaming System (MSS)** is a full-featured web-based application that allows users to search and stream movies directly from their browser, eliminating the need for physical media or third-party software. Built to offer a smooth and enjoyable streaming experience, MSS also empowers content creators and distributors to reach a larger audience and manage their media catalog with ease.

## 📌 Features
- Search & stream movies
- User registration and login
- Admin panel for movie upload/edit
- Review submission with duplicate detection
- Responsive UI

## 🔧 Tech Stack
- **Frontend**: HTML, CSS, JavaScript  
- **Backend**: PHP  
- **Database**: MySQL  

## 🧪 Testing

### Unit Testing

| Test ID | Scenario              | Input                                    | Expected Output                     | Result |
|---------|-----------------------|------------------------------------------|-------------------------------------|--------|
| T01     | Admin Login (Valid)   | `pragya@gmail.com / Pragya@123`          | Admin dashboard                     | Pass   |
| T02     | Admin Login (Invalid) | `pragyaa@gmail.com / user@123`           | Error: Invalid Details              | Pass   |
| T03     | User Login (Valid)    | `xyz@gmail.com / Xyz@123`                | Redirect to user homepage           | Pass   |
| T04     | User Login (Invalid)  | `Xyz132@gmail / hehe@123`                | Error: Invalid Details              | Pass   |
| T05     | Empty Login Fields    | No input                                 | Error: Enter username and password  | Pass   |

### System Testing

| Test ID | Scenario                          | Input Summary                            | Expected Output                           | Result |
|--------|-----------------------------------|------------------------------------------|-------------------------------------------|--------|
| S01    | Valid User Registration           | Valid inputs                              | Redirect to login                         | Pass   |
| S02    | Invalid Registration              | Mismatched password, bad email, etc.      | Show validation errors                     | Fail   |
| S03    | Login with correct credentials    | `pragya@gmail.com / pp@#12345`            | Login success                             | Pass   |
| S04    | Login with incorrect credentials  | `test@gmail.com / test1`                  | Error: password too short                 | Fail   |
| S05    | Upload Movie (Admin)              | Valid movie data                          | Movie uploaded successfully               | Pass   |
| S06    | Edit Movie Details (Admin)        | Updated valid movie data                  | Edited successfully                        | Pass   |
| S07    | Search Movie (Admin)              | `Phir Hera Pheri`                         | Search result found                        | Pass   |
| S08    | Search Movie (User)               | `Phir Hera Pheri`                         | Search result found                        | Pass   |
| S09    | Search Random Movie (Admin)       | `aaaa`                                    | No results found                           | Fail   |
| S10    | Search Random Movie (User)        | `KKKKKK`                                  | No results found                           | Fail   |
| S11    | Review Submission (User)          | "The movie was really funny."             | Review posted                              | Pass   |
| S12    | Duplicate Review (User)           | "I love this movie."                      | Already reviewed warning                   | Fail   |

## 🔐 Roles

### User
- Register, login, search, stream
- Submit and read reviews

### Admin
- Login
- Upload/edit/delete movies
- View uploaded content
- Moderate reviews

## 📂 Structure

MSS/
├── index.php
├── login.php
├── register.php
├── admin/
│ ├── dashboard.php
│ ├── upload.php
│ └── edit.php
├── includes/
│ ├── db.php
│ └── auth.php
├── assets/
│ ├── css/
│ ├── js/
│ └── uploads/
└── README.md

markdown
Copy
Edit

## 🚫 Limitations
- No adaptive streaming
- No modern JS frontend
- No payment or subscriptions

## 💡 Future Enhancements
- Add subscriptions/payments
- Frontend SPA with Vue or React
- Subtitles and streaming CDN
- Multi-user ratings

## 🤝 Credits
Built by **Prajna Chauhan** as part of an academic project.  
Backend: PHP & MySQL.
