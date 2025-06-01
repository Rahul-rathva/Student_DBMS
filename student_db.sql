-- MySQL schema and data
CREATE DATABASE IF NOT EXISTS StudentDB;
USE StudentDB;

CREATE TABLE IF NOT EXISTS Students (
    StudentID INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Email VARCHAR(100),
    DOB DATE,
    Department VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS Courses (
    CourseID INT PRIMARY KEY AUTO_INCREMENT,
    CourseName VARCHAR(100),
    Credits INT
);

CREATE TABLE IF NOT EXISTS Enrollments (
    EnrollmentID INT PRIMARY KEY AUTO_INCREMENT,
    StudentID INT,
    CourseID INT,
    Grade VARCHAR(2),
    FOREIGN KEY (StudentID) REFERENCES Students(StudentID),
    FOREIGN KEY (CourseID) REFERENCES Courses(CourseID)
);

INSERT INTO Students (FirstName, LastName, Email, DOB, Department) VALUES
('Rahul', 'Rathva', 'rahul@example.com', '2002-05-12', 'Computer Science'),
('Aditi', 'Sharma', 'aditi@example.com', '2001-11-23', 'Electrical');

INSERT INTO Courses (CourseName, Credits) VALUES
('Data Structures', 4),
('Operating Systems', 3);

INSERT INTO Enrollments (StudentID, CourseID, Grade) VALUES
(1, 1, 'A'),
(2, 2, 'B');

CREATE INDEX idx_student_id ON Students(StudentID);
