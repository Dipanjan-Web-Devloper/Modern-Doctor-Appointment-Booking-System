# Modern Doctor Appointment Booking System

## 🩺 Project Description

The **Modern Doctor Appointment Booking System** is a full-stack web application built with the MERN (MongoDB, Express.js, React.js, Node.js) stack that enables users to book doctor appointments online. It provides a seamless experience for three types of users — **Patients**, **Doctors**, and **Admins** — allowing each role to access the features they need in a secure and organized way. The frontend is designed using React and Ant Design for a clean, professional look, while the backend is powered by Node.js and Express, with MongoDB handling data persistence.

This application is designed for clinics, hospitals, or healthcare startups seeking to digitize their appointment scheduling, improve patient experience, and streamline doctor management. The project also supports authentication, protected routes, role-based dashboards, and real-time appointment booking capabilities.

Live Demo: 🌐 [https://spontaneous-quokka-feb63b.netlify.app/](https://spontaneous-quokka-feb63b.netlify.app/)

---

## 🔍 Core Modules & Features

### 🧑 Patient Portal:

* User-friendly registration and login system
* Book appointments by selecting doctor, date, and time
* View appointment status (approved/pending/rejected)
* Access appointment history
* Mobile-responsive dashboard

### 🩺 Doctor Dashboard:

* Login authentication for doctors
* View appointment requests
* Approve or reject appointment bookings
* View personal appointment schedule
* Secure, doctor-only access via protected routes

### 🧑‍💼 Admin Panel:

* Admin login with elevated privileges
* View list of all doctors and users
* Approve new doctor accounts manually
* Access to all appointment data across the platform
* Role-based redirection after login

---

## ⚙️ Technical Details

### Tech Stack:

* **Frontend**: React.js, React Router, Ant Design, Axios
* **Backend**: Node.js, Express.js
* **Database**: MongoDB with Mongoose ODM
* **Authentication**: JWT (JSON Web Token)
* **Hosting**: Frontend on Netlify, Backend locally (or can be deployed on Render/Railway)

### Architecture Highlights:

* RESTful API built with Express.js
* Mongoose schema models for User, Doctor, and Appointment
* Middleware for protected routes and role-based access
* Toast notifications for success/error feedback
* Centralized Axios instance for API communication

---

## 🔐 Authentication & Security

* Secure login with hashed passwords (using bcrypt)
* JWT-based session management
* Frontend route protection for authenticated users
* Role-based access control (patient/doctor/admin)
* Form validation and error handling

---

## 📦 Folder Structure Overview

```
Modern-Doctor-Appointment-Booking-System/
├── client/ (Frontend React App)
│   └── src/
│       ├── components/
│       ├── pages/
│       ├── context/AuthContext.js
│       └── App.js
├── server/ (Backend Node API)
│   ├── models/ (Mongoose models)
│   ├── routes/ (Express routers)
│   ├── controllers/ (Business logic)
│   ├── middleware/ (Auth middleware)
│   └── server.js
```

---

## 🛠 Setup Instructions

### Prerequisites:

* Node.js & npm
* MongoDB local instance or Atlas Cloud

### Step-by-step Guide:

```bash
# Clone the repo
git clone https://github.com/Dipanjan-Web-Devloper/Modern-Doctor-Appointment-Booking-System

# Setup Backend
cd server
npm install

# Create .env file
PORT=5000
MONGO_URI=your_mongo_connection_string
JWT_SECRET=your_secret_key
npm run server

# Setup Frontend
cd ../client
npm install
npm start
```

---

## 📌 Use Cases

* Hospital appointment management system
* Online doctor booking platform
* Clinic scheduling software
* Telemedicine support base layer

---

## 🚀 Future Roadmap

* Payment integration for paid appointments
* Backend deployment (e.g., on Render or Railway)
* Email and SMS appointment notifications
* Doctor profile ratings and reviews
* Calendar integration for reminders

---

## 👤 Author

**Dipanjan Das**
## 👨‍💻 About Me

Hi, I'm **Dipanjan Das**, a versatile and detail-oriented Full Stack Developer passionate about creating impactful digital solutions. I specialize in building scalable, user-friendly web applications using modern technologies like React, Node.js, and MongoDB.

### 🌐 Professional Summary:

* Proficient in full-stack development (MERN & LAMP stack)
* Experienced with cloud infrastructure including AWS EC2, Lambda, and S3
* Strong foundation in Data Structures, Algorithms, and Object-Oriented Programming
* Comfortable working in fast-paced, team-oriented environments with agile practices

### 🚀 Skills Snapshot:

* **Frontend**: React.js, HTML5, CSS3, JavaScript (ES6+), Bootstrap, jQuery
* **Backend**: Node.js, Express.js, PHP
* **Database**: MongoDB, MySQL, Microsoft SQL Server
* **Cloud & DevOps**: AWS, GitHub, Jenkins, Linux, Shell Scripting

### 💼 Experience:

* Full Stack Developer Intern at Mollos Radix Solutions (Jan–Dec 2023)
* Currently teaching Computer Technology at UCSB Foundation Society

### 📚 Education:

* B.Tech in Computer Science & Engineering, Bengal College of Engineering & Technology, 2024

### 📫 Contact:

* 📧 Email: [dasbittu133@gmail.com](mailto:dasbittu133@gmail.com)
* 🔗 Portfolio: [www.dipanjandas.site](http://www.dipanjandas.site)
* 🔗 LinkedIn: [linkedin.com/in/dipanjan-das-a12827324](https://www.linkedin.com/in/dipanjan-das-a12827324)


---

## 📃 License

MIT License — Free for personal and commercial use.
