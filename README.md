# Epywiki

**Epywiki** is an epidemiological wiki designed to track disease data.


---

## Overview
- Built with **vanilla CSS**, **JavaScript**, **PHP**, and **SQLite** for simplicity and portability.
- Download the repository from GitHub and install it in `xampp/htdocs` (for Windows).

## Users & Roles

- The first user to set up the site becomes the **admin**.
- Admins can add other users as **editors**.
- Editors can add diseases and assign it to various wards in Kenya.

### Login System

The login system works as follows:

1. Users submit a request to become editors (username and email).
2. Admin approves the request.
3. Admin sends a **set-password link** to the user.
4. Users finish setting up their account and establish a password.
5. Users can then use their emails and passwords to login.
6. The forgot password logic hasnt been implemented.

> Note: The system is in its early stages and doesnt work as expected.Comments and contributions are highly welcomed.

## Epidemiological Data

- Data tracked includes **cases**, **deaths**, **report dates**, and **notes**.
- Notes use **Markdown** for references and structured data.

## Limitations & Future Work

- Version control, discussion/talk pages, and richer user accounts are not yet implemented.
- Initially the site was to be a way for volunteers to add their own data but it will only be feasible if we use secondary data.
- Expanding to other countries requires understanding their local administrative structures and data accuracy thresholds. 
- Clean routing has been achieved with `Bramus router`.

## Contributing

- The project structure is simple to encourage easy contributions.
- Early-stage project: expect bugs and limited features.

---

Thank you for exploring **Epywiki**. Contributions and suggestions are welcome!


