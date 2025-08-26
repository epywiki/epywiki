# Contributing to Epywiki

Thank you for your interest in contributing to **Epywiki**! This project is still in its early stages, so any contributions—big or small—are greatly appreciated.

---

## Project Overview

**Epywiki** is a lightweight epidemiological wiki built with:

- **PHP (vanilla)** with a custom MVC structure
- **SQLite** for the database
- **HTML, CSS, and JavaScript** for the frontend
- Markdown support for notes and references

The project currently focuses on **Africa**, tracking diseases, cases, deaths, and epidemiological reports.

---

## Project Structure

Refer to `structure.md` for the complete file structure. Key directories include:

- `public/` – Publicly accessible files, front controller (`index.php`), CSS, JS, images, fonts, and data files.
- `app/` – Core application files:
  - `controllers/` – Handles application logic (Auth, Dashboard, Disease, Report, Location, Home)
  - `models/` – Database and data models (User, Disease, Report, Location)
  - `views/` – Templates for HTML/PHP pages (login, dashboards, forms, reports)
  - `config.php` – Configuration and DB connection
  - `functions.php` – Helper functions
  - `init.php` – Initializes the app on every request

- `epywiki.sqlite` – The SQLite database file
- `web.php` – Routing definitions
- `views/install_admin.php` – Initial installation script
- `README.md` – Project documentation

---

## How to Contribute

1. **Fork the repository** and create a new branch for your feature or bugfix.
2. **Clone** your forked repository locally.
3. 4.Using XAMMP(windows) extract and upload the zip folder into the `htdocs` folder.
4. Create a new folder called `epywiki`.
5. In the browser search for `localhost/epywiki/epwywiki/public`
6. Make your changes following the project’s **MVC structure**.
7. Test your changes thoroughly.
8. Submit a **pull request** with a clear description of your changes.

---

## Areas Where Help Is Needed

- **Location Support:** The current location divisions is based on simple administrative divisions.
- **User System:** Improve account management, login, and editor workflows.
- **Version Control for Wiki Pages:** Track edits and revisions.
- **UI/UX:** Enhance the frontend experience using CSS/JS.
- **Data Handling:** Improve epidemiological data input and reporting.
- **Documentation:** Improve `README.md`, code comments, and setup instructions.
- **Clean routing:** Improve the files and help remove the `index.php?` route for every page without apache_rewrite and interference with core files.

---

## Coding Guidelines

- Follow the **existing PHP MVC structure**.
- Keep code readable and commented.
- Use **prepared statements** for database queries.
- Keep frontend files separated in `public/css` and `public/js`.
- Use Markdown for notes and references wherever possible.

---
## Much Thanks To

1. **Parsedown authors**  
   For creating and maintaining [`Parsedown.php`](https://github.com/erusev/parsedown) — a **single-file**, **dependency-free**, and **super-fast** Markdown parser written in PHP. It makes Markdown integration simple and elegant!

2. **Bramus router author** - For clean routing for more details go to [`Bramus router`](https:github.com/bramus/router)
 

Thank you for helping make **Epywiki** better! Your contributions will help build a reliable, easy-to-use epidemiological wiki.



