-- Creating school_management database, if not exists
CREATE DATABASE IF NOT EXISTS school_management;

-- Using school_management database
USE school_management;

-- Creating students table, if not exists
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    birth_date DATE NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE
);

-- Creating classes table, if not exists
CREATE TABLE IF NOT EXISTS classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    type VARCHAR(255) NOT NULL
);

-- Creatin enrollments table, if not exists
CREATE TABLE IF NOT EXISTS enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    class_id INT NOT NULL,
    enrollment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE
);

-- Creating enrollments, if not exists
CREATE TABLE users IF NOT EXISTS (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Inserting 4 students
INSERT INTO students (name, birth_date, username) VALUES
('Carlos Silva', '1998-03-15', 'carlos.silva'),
('Ana Oliveira', '2000-07-22', 'ana.oliveira'),
('Pedro Santos', '1999-11-30', 'pedro.santos'),
('Maria Souza', '2001-02-10', 'mariasouza');

-- Inserting 4 classes
INSERT INTO classes (name, description, type) VALUES
('Análise de Dados', 'Curso voltado para análise e interpretação de dados.', 'Pós Graduação'),
('Engenharia de Software', 'Curso sobre práticas e metodologias de desenvolvimento de software.', 'Graduação'),
('Gestão de Projetos', 'Curso para desenvolvimento de habilidades em gestão de projetos.', 'MBA'),
('Design de Interfaces', 'Curso voltado para criação de interfaces de usuário eficientes.', 'Tecnólogo');
