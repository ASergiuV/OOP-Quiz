create database Quiz;
use Quiz;

create table ANSWER
(
  id    int(6) unsigned auto_increment
    primary key,
  text  varchar(250)     not null,
  score tinyint unsigned null
);

create table QUESTION
(
  id   int(6) unsigned auto_increment
    primary key,
  text varchar(250) not null
)
  charset = utf8;

create table QUESTION_ANSWER
(
  questionID int(6) unsigned null,
  answerID   int(6) unsigned null,
  constraint QUESTION_ANSWER_ibfk_1
  foreign key (questionID) references QUESTION (id),
  constraint QUESTION_ANSWER_ibfk_2
  foreign key (answerID) references ANSWER (id)
);

create index answerID
  on QUESTION_ANSWER (answerID);

create index questionID
  on QUESTION_ANSWER (questionID);

create table QUIZ
(
  id       int(6) unsigned auto_increment
    primary key,
  maxScore int(6) unsigned null
)
  charset = utf8;

create table QUIZ_QUESTION
(
  questionID int(6) unsigned null,
  quizID     int(6) unsigned null,
  constraint QUIZ_QUESTION_ibfk_1
  foreign key (questionID) references QUESTION (id),
  constraint QUIZ_QUESTION_ibfk_2
  foreign key (quizID) references QUIZ (id)
);

create index questionID
  on QUIZ_QUESTION (questionID);

create index quizID
  on QUIZ_QUESTION (quizID);

create table USER
(
  id    int(6) unsigned auto_increment
    primary key,
  email varchar(250)    not null,
  score int default '0' null
);

