CREATE TABLE `coaches` (
  `id` int PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) UNIQUE NOT NULL,
  `oauth_provider` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL COMMENT 'path to profile image'
);

CREATE TABLE `courses` (
  `id` int PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `coach_id` int NOT NULL
);

CREATE TABLE `students` (
  `id` int PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `birth_year` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL COMMENT 'path to profile image'
);

CREATE TABLE `enrollments` (
  `id` int PRIMARY KEY,
  `student_id` int NOT NULL,
  `course_id` int NOT NULL,
  `enrolled_at` datetime NOT NULL
);

CREATE TABLE `progress` (
  `id` int PRIMARY KEY,
  `student_id` int NOT NULL,
  `course_id` int NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL
);

CREATE TABLE `homework` (
  `id` int PRIMARY KEY,
  `course_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `open_at` datetime NOT NULL,
  `due_at` datetime NOT NULL
);

CREATE TABLE `submissions` (
  `id` int PRIMARY KEY,
  `homework_id` int NOT NULL,
  `student_id` int NOT NULL,
  `text` text NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `submitted_at` datetime NOT NULL,
  `grade` tinyint COMMENT '1–5, 5 = nejlepší'
);

ALTER TABLE `courses` ADD FOREIGN KEY (`coach_id`) REFERENCES `coaches` (`id`);

ALTER TABLE `enrollments` ADD FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

ALTER TABLE `enrollments` ADD FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

ALTER TABLE `progress` ADD FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

ALTER TABLE `progress` ADD FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

ALTER TABLE `homework` ADD FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

ALTER TABLE `submissions` ADD FOREIGN KEY (`homework_id`) REFERENCES `homework` (`id`);

ALTER TABLE `submissions` ADD FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
