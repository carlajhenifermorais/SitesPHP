DROP DATABASE IF EXISTS gestao_escolar;
CREATE DATABASE IF NOT EXISTS gestao_escolar;
USE gestao_escolar;

-- 1. Departamentos
CREATE TABLE departamentos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL
);

-- 2. Professores
CREATE TABLE professores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    cpf CHAR(11) UNIQUE NOT NULL,
    departamento_id INT,
    FOREIGN KEY (departamento_id) REFERENCES departamentos(id)
);

-- 3. Cursos
CREATE TABLE cursos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    duracao_semestres INT
);

-- 4. Disciplinas
CREATE TABLE disciplinas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    carga_horaria INT NOT NULL,
    curso_id INT,
    FOREIGN KEY (curso_id) REFERENCES cursos(id)
);

-- 5. Alunos
CREATE TABLE alunos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    ra CHAR(8) UNIQUE NOT NULL,
    data_nascimento DATE,
    curso_id INT,
    FOREIGN KEY (curso_id) REFERENCES cursos(id)
);

-- 6. Turmas (Relaciona Professor, Disciplina e Horário)
CREATE TABLE turmas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ano_letivo INT NOT NULL,
    semestre INT NOT NULL,
    disciplina_id INT,
    professor_id INT,
    FOREIGN KEY (disciplina_id) REFERENCES disciplinas(id),
    FOREIGN KEY (professor_id) REFERENCES professores(id)
);

-- 7. Matriculas (Relacionamento N:N entre Alunos e Turmas)
CREATE TABLE matriculas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    aluno_id INT,
    turma_id INT,
    data_matricula DATE DEFAULT (CURRENT_DATE),
    status ENUM('Ativo', 'Trancado', 'Concluido') DEFAULT 'Ativo',
    FOREIGN KEY (aluno_id) REFERENCES alunos(id),
    FOREIGN KEY (turma_id) REFERENCES turmas(id)
);

-- 8. Avaliacoes
CREATE TABLE avaliacoes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    turma_id INT,
    descricao VARCHAR(100),
    peso DECIMAL(3,2),
    FOREIGN KEY (turma_id) REFERENCES turmas(id)
);

-- 9. Notas
CREATE TABLE notas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    matricula_id INT,
    avaliacao_id INT,
    valor_nota DECIMAL(4,2),
    FOREIGN KEY (matricula_id) REFERENCES matriculas(id),
    FOREIGN KEY (avaliacao_id) REFERENCES avaliacoes(id)
);

-- 10. Frequencia
CREATE TABLE frequencia (
    id INT PRIMARY KEY AUTO_INCREMENT,
    matricula_id INT,
    data_aula DATE NOT NULL,
    presenca BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (matricula_id) REFERENCES matriculas(id)
);



USE gestao_escolar;

-- 1. Inserção em DEPARTAMENTOS
INSERT INTO departamentos (nome) VALUES 
('Tecnologia da Informação'),
('Ciências Exatas'),
('Ciências Humanas'),
('Artes e Design');

-- 2. Inserção em PROFESSORES
INSERT INTO professores (nome, cpf, departamento_id) VALUES 
('Ricardo Lima', '12345678901', 1),
('Sonia Abrão', '22233344455', 2),
('Marcos Paulo', '33344455566', 3),
('Beatriz Silva', '44455566677', 4);

-- 3. Inserção em CURSOS
INSERT INTO cursos (nome, duracao_semestres) VALUES 
('Análise e Desenvolvimento de Sistemas', 5),
('Engenharia de Software', 8),
('História', 8),
('Design Gráfico', 6);

-- 4. Inserção em DISCIPLINAS
INSERT INTO disciplinas (nome, carga_horaria, curso_id) VALUES 
('Algoritmos e Lógica', 80, 1),
('Banco de Dados SQL', 80, 1),
('Cálculo I', 100, 2),
('Brasil Colônia', 60, 3),
('Teoria das Cores', 40, 4);

-- 5. Inserção em ALUNOS
INSERT INTO alunos (nome, ra, data_nascimento, curso_id) VALUES 
('Lucas Mendes', '20240001', '2002-05-15', 1),
('Mariana Costa', '20240002', '2001-10-20', 1),
('João Pedro', '20240003', '1998-03-12', 2),
('Fernanda Lima', '20240004', '2003-07-25', 3);

-- 6. Inserção em TURMAS
-- (Relacionando uma disciplina a um professor num ano/semestre específico)
INSERT INTO turmas (ano_letivo, semestre, disciplina_id, professor_id) VALUES 
(2024, 1, 1, 1), -- Algoritmos com Ricardo
(2024, 1, 2, 1), -- Banco de Dados com Ricardo
(2024, 1, 3, 2), -- Cálculo I com Sonia
(2024, 1, 4, 3); -- História com Marcos

-- 7. Inserção em MATRICULAS (Alunos entrando nas turmas)
INSERT INTO matriculas (aluno_id, turma_id, status) VALUES 
(1, 1, 'Ativo'), -- Lucas em Algoritmos
(1, 2, 'Ativo'), -- Lucas em Banco de Dados
(2, 2, 'Ativo'), -- Mariana em Banco de Dados
(3, 3, 'Ativo'), -- João em Cálculo
(4, 4, 'Ativo'); -- Fernanda em História

-- 8. Inserção em AVALIACOES (Planejamento das provas/trabalhos)
INSERT INTO avaliacoes (turma_id, descricao, peso) VALUES 
(2, 'Prova Mensal - SQL', 0.40),
(2, 'Projeto de Modelagem', 0.60),
(3, 'Exame de Cálculo', 1.00);

-- 9. Inserção em NOTAS (Resultados dos alunos por avaliação)
INSERT INTO notas (matricula_id, avaliacao_id, valor_nota) VALUES 
(2, 1, 8.5), -- Lucas na Prova de SQL
(2, 2, 9.0), -- Lucas no Projeto
(3, 1, 7.0), -- Mariana na Prova de SQL
(3, 2, 8.0); -- Mariana no Projeto

-- 10. Inserção em FREQUENCIA (Registro de chamadas)
INSERT INTO frequencia (matricula_id, data_aula, presenca) VALUES 
(1, '2024-03-10', 1),
(1, '2024-03-11', 1),
(2, '2024-03-10', 1),
(2, '2024-03-11', 0), -- Mariana faltou
(3, '2024-03-10', 1);