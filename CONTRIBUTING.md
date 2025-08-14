# Contributing to Epywiki

Thank you for your interest in contributing to **Epywiki**! This project is still in its early stages, so any contributions—big or small—are greatly appreciated.

---

## Project Overview

**Epywiki** is a lightweight epidemiological wiki built with:

- **PHP (vanilla)** with a custom MVC structure
- **SQLite** for the database
- **HTML, CSS, and JavaScript** for the frontend
- Markdown support for notes and references

The project currently focuses on **Kenya**, tracking diseases, cases, deaths, and epidemiological reports.

---

## Project Structure

Refer to `structure.md` for the complete file structure. Key directories include:

- `public/` – Publicly accessible files, front controller (`index.php`), CSS, JS, images, fonts, and data files.
- `app/` – Core application files:
  - `controllers/` – Handles application logic (Auth, Dashboard, Disease, EpiData, Location, Home)
  - `models/` – Database and data models (User, Disease, EpiData, Location)
  - `views/` – Templates for HTML/PHP pages (login, dashboards, forms, reports)
  - `config.php` – Configuration and DB connection
  - `functions.php` – Helper functions
  - `init.php` – Initializes the app on every request

- `epywiki.sqlite` – The SQLite database file
- `web.php` – Routing definitions
- `install.php` – Initial installation script
- `README.md` – Project documentation

---

## How to Contribute

1. **Fork the repository** and create a new branch for your feature or bugfix.
2. **Clone** your forked repository locally.
3. Make your changes following the project’s **MVC structure**.
4. Test your changes thoroughly.
5. Submit a **pull request** with a clear description of your changes.

---

## Areas Where Help Is Needed

- **Location Support:** Extend beyond Kenya and manage multiple countries’ administrative divisions.
- **User System:** Improve account management, login, and editor workflows.
- **Version Control for Wiki Pages:** Track edits and revisions.
- **UI/UX:** Enhance the frontend experience using CSS/JS.
- **Data Handling:** Improve epidemiological data input and reporting.
- **Documentation:** Improve `README.md`, code comments, and setup instructions.

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

2. **kenya-administrative-divisions author**  
   I would like to extend o sincere appreciation to the developer who contributed the comprehensive dataset of Kenyan counties, subcounties, and wards in JSON format. This invaluable resource has significantly enhanced the accuracy and usability of our project. Your dedication to making this data freely available is deeply appreciated.  
   You can explore the dataset here: [Kenya Administrative Divisions - county.json](https://github.com/michaelnjuguna/kenya-administrative-divisions/blob/main/county.json)


Thank you for helping make **Epywiki** better! Your contributions will help build a reliable, easy-to-use epidemiological wiki.



