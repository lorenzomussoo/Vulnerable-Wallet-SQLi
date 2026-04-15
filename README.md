# Vulnerable Wallet - SQL Injection Lab 💳🔓

This repository contains a deliberately vulnerable web application designed to demonstrate the mechanics and impact of **in-band SQL Injection (SQLi)** attacks. It serves as an educational laboratory for cybersecurity and penetration testing.

## 🎯 Project Overview
The application, named "Wallet", simulates a virtual credit card management system. Users can log in using a username and password to view their stored credit cards. The application was intentionally built without input sanitization or prepared statements, allowing the direct execution of arbitrary SQL commands from the user input fields.

## 🏗️ Architecture & Tech Stack
The project is deployed in a controlled, isolated environment ensuring that the vulnerabilities can be tested safely:
* **Backend & Frontend:** PHP (v8.1), HTML, JavaScript.
* **Database:** MariaDB.
* **Containerization:** Docker & Docker Compose (`docker-compose.yml`, custom `Dockerfile`, and `init.sql` for automated database population).

## ⚔️ Demonstrated Attack Techniques
The environment allows testing multiple SQLi vectors, specifically targeting the login form and the data-fetching endpoints:
1. **Tautologies:** Forcing always-true conditions (e.g., `OR '1'='1'`) to bypass the authentication controls without knowing a valid password.
2. **End-of-Line Comments:** Using `--` or `#` to truncate queries and ignore legitimate server-side SQL logic.
3. **Piggybacked Queries:** Using `;` to append and execute entirely new SQL commands alongside the original query, allowing for complex multi-stage attacks.

## 📊 Impact on the CIA Triad
The project meticulously documents how these vulnerabilities directly compromise the core principles of information security:

| Violated Property | Technique Used | Attack Example & Consequence |
| :--- | :--- | :--- |
| **Confidentiality** | Tautology & Comments | `' OR '1'='1` inserted in the password field to exfiltrate unauthorized data and access other users' wallets. |
| **Integrity** | Piggybacked Query | Injecting an `UPDATE` statement to modify a credit card's CVV, or an `INSERT` statement to silently add a rogue user to the system. |
| **Availability** | Piggybacked Query | Executing `DROP TABLE credit_cards;` causing data loss and a Denial of Service (DoS) for the entire web application. |

## 🚀 How to Run Locally

### Prerequisites
* [Docker](https://www.docker.com/) and Docker Compose installed on your machine.

### Installation
1. Clone this repository:
   ```bash
   git clone [https://github.com/yourusername/SQL-Injection-Vulnerable-Wallet.git](https://github.com/yourusername/SQL-Injection-Vulnerable-Wallet.git)
   cd SQL-Injection-Vulnerable-Wallet

2. Build and start the containers using Docker Compose:
   ```bash
   docker-compose up -d --build

3. Open your browser and navigate to http://localhost:8080 (or the port specified in your configuration) to access the login page.

4. Check the public/debug_log.txt file (if enabled) to track the exact SQL queries being executed by the server.

---
_⚠️ Disclaimer: This project was developed strictly for educational purposes as part of a University Cybersecurity course. The code contains severe security flaws and should never be deployed in a production environment. Only test vulnerabilities on systems you have explicit permission to attack._
