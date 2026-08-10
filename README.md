# Database Tutorial — Student CRUD App

A beginner-friendly **PHP + MySQL** project that manages a list of students. It is a
complete **CRUD** example — the four basic operations every database app is built from:

| Letter | Operation | File in this project |
| ------ | --------- | -------------------- |
| **C**  | Create    | `add.php`            |
| **R**  | Read      | `index.php`          |
| **U**  | Update    | `edit.php`           |
| **D**  | Delete    | `delete.php`         |

The goal is to learn how a web page talks to a database: connect, run SQL queries
(`SELECT`, `INSERT`, `UPDATE`, `DELETE`), and show the results in HTML.

---

## What each file does

- **`db.php`** — Connects PHP to the MySQL database using `mysqli`. Every other page
  starts with `include 'db.php';` so it can reuse this connection.
- **`index.php`** — The home page. Runs a `SELECT` query and lists all students in a
  table, with **Edit** and **Delete** links on each row, plus an **Add New Student** link.
- **`add.php`** — Shows a form. When submitted, it runs an `INSERT` to save a new student,
  then redirects back to the list.
- **`edit.php`** — Reads one student by `id` (from the URL, e.g. `edit.php?id=3`), fills a
  form with their current details, and runs an `UPDATE` when you save.
- **`delete.php`** — Removes one student by `id`, then redirects back to the list. It has
  no page of its own; it just does the work and sends you back.

---

## The database

This app expects a MySQL database named **`database-tuto`** with one table, **`students`**.

Create it by running this SQL (in phpMyAdmin, DBeaver, or the `mysql` command line):

```sql
CREATE DATABASE IF NOT EXISTS `database-tuto`;
USE `database-tuto`;

CREATE TABLE students (
  id     INT AUTO_INCREMENT PRIMARY KEY,
  name   VARCHAR(100) NOT NULL,
  email  VARCHAR(100) NOT NULL,
  course VARCHAR(100) NOT NULL
);

-- Optional: a couple of sample rows to see the list working
INSERT INTO students (name, email, course) VALUES
  ('Ali',  'ali@example.com',  'Computer Science'),
  ('Siti', 'siti@example.com', 'Information Technology');
```

**Table columns:** `id` (auto-numbered key), `name`, `email`, `course`.

---

## Setup & configuration

Open **`db.php`** and match the settings to your own database server:

```php
$servername = "localhost";
$username   = "root";
$password   = "sayang123"; // your MySQL password — leave "" (empty) if you use XAMPP
$dbname     = "database-tuto";
```

> The password `sayang123` is just the sample value used on the author's machine.
> On a fresh **XAMPP** install the MySQL password is usually empty, so set it to `""`.

---

## How to run

This project lives in the **Laravel Herd** sites folder (`~/Herd`), so Herd serves it
automatically. Make sure MySQL is running, then open:

```
http://database-tuto.test
```

**Not using Herd?** Any PHP + MySQL setup works. For example with XAMPP, copy this folder
into `htdocs/` and visit `http://localhost/database-tuto/index.php`.

You should land on the **Student List** page. From there you can add, edit, and delete
students and watch the database change.

---

## How it flows

```
index.php  ──"Add New Student"──▶  add.php   ──INSERT──▶  back to index.php
    │
    ├──"Edit"  (edit.php?id=N)   ──▶  edit.php   ──UPDATE──▶  back to index.php
    │
    └──"Delete" (delete.php?id=N) ─▶  delete.php ──DELETE──▶  back to index.php
```

Notice how the `id` is passed in the URL (`?id=N`) so the Edit and Delete pages know
*which* student to act on.

---

## Learning notes ⚠️

This code is written to be **simple and easy to read for learning**. It is **not safe for
a real, public website** yet. Once you understand the basics, these are the next things to
learn and improve:

1. **SQL Injection** — The queries paste user input straight into the SQL string, e.g.
   `"... WHERE id=$id"`. A malicious user could abuse this. The proper fix is
   **prepared statements** (`$conn->prepare(...)` with bound parameters).
2. **Output escaping (XSS)** — Values from the database are echoed directly into HTML.
   Real apps wrap them in `htmlspecialchars(...)` so user input can't inject `<script>`.
3. **Input validation** — There are no checks that the name/email/course are filled in or
   valid before saving.
4. **Separation of concerns** — HTML, PHP logic, and SQL are all mixed in one file. Larger
   projects split these apart (and often use a framework like Laravel).

Treat those as your homework once the CRUD flow makes sense. 🎓

---

## Quick glossary

- **CRUD** — Create, Read, Update, Delete: the four basic things you do to data.
- **`mysqli`** — "MySQL Improved", the PHP extension used here to talk to MySQL.
- **`$_POST`** — Data sent from an HTML form (used in `add.php` and `edit.php`).
- **`$_GET`** — Data read from the URL, like `?id=3` (used in `edit.php` and `delete.php`).
- **`header("Location: ...")`** — Tells the browser to redirect to another page.
