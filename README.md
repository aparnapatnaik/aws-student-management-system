# AWS Student Management System

A cloud-based student management system built using PHP and AWS. This project stores student information in Amazon RDS and uploads student profile images to Amazon S3.

## Features

- Add, edit and delete student records
- Search students
- Sort student records
- Upload profile images to Amazon S3
- Store student data in Amazon RDS
- Responsive Bootstrap interface

## Technologies Used

- PHP
- MySQL
- Bootstrap
- AWS SDK for PHP

## AWS Services

- Amazon EC2
- Amazon RDS
- Amazon S3
- IAM

## Project Structure

```
studentapp/
├── assets/
├── index.php
├── form.php
├── list.php
├── edit.php
├── delete.php
├── header.php
├── footer.php
├── composer.json
└── config.example.php
```

## Setup

1. Launch an EC2 instance.
2. Install Apache, PHP and Composer.
3. Create an RDS MySQL database.
4. Create an S3 bucket.
5. Configure `config.php` and `s3_config.php`.
6. Install dependencies:

```bash
composer install
```

7. Open the application in your browser.
8. ## 📸 Screenshots

### Home Page
![Home Page](screenshots/home.png)

### Add Student
![Add Student](screenshots/add-student.png)

### Student List
![Student List](screenshots/student-list.png)

### Amazon S3 Bucket
![Amazon S3](screenshots/s3-bucket.png)

### Amazon RDS
![Amazon RDS](screenshots/rds.png)

### Amazon EC2
![Amazon EC2](screenshots/ec2.png)

## Future Improvements

- User authentication
- Dashboard
- Pagination
- REST API
- Docker support

## Author

**Aparna Patnaik**
