CREATE DATABASE wallet;

USE wallet;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50)
);

CREATE TABLE credit_cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    card_number VARCHAR(20),
    expiry_date VARCHAR(10),
    cvv VARCHAR(5),
    circuit VARCHAR(20),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (username, password) VALUES
('alice', 'alice123'),
('bob', 'bobpass'),
('sara', 'saretta12'),
('mario', 'mario01'),
('giulia', 'giu_pass'),
('lorenzo', 'loreciaoo'),
('andrea', 'and123'),
('luca', 'lucatop'),
('francesca', 'frafra'),
('giovanni', 'gio_321'),
('chiara', 'chichi'),
('marco', 'marco_pw'),
('elena', 'elena456'),
('federico', 'fede'),
('valentina', 'val123'),
('roberto', 'rob78');

INSERT INTO credit_cards (user_id, card_number, expiry_date, cvv, circuit) VALUES
(1, '4556737586899855', '03/27', '321', 'Visa'),  
(1, '5296801234567890', '10/26', '654', 'Mastercard'),  
(1, '378734493671000',  '08/28', '987', 'American Express'), 
(1, '4528763919783719', '01/29', '741', 'Visa'),  
(1, '4376592567785868', '12/26', '137', 'Visa'),
(2, '5544921245748524', '08/25', '464', 'Mastercard'),
(3, '4532756279624064', '07/25', '312', 'Visa'),
(4, '5425233430109903', '09/27', '231', 'Mastercard'),
(4, '4485123498761234', '10/26', '908', 'Visa'),
(5, '4716108999716531', '04/28', '001', 'Visa'),
(6, '60115564485789458', '11/26', '645', 'Discover'),
(6, '5281037036353902', '02/27', '832', 'Mastercard'),
(7, '4020056655665556', '03/26', '777', 'Visa'),
(8, '6011003990139424', '06/25', '159', 'Discover'),
(9, '2223000048400011', '05/29', '444', 'Mastercard'),
(9, '4109328133332222', '12/27', '852', 'Visa'),
(10, '378282246310005',  '09/25', '123', 'American Express'),
(11, '5105105105105100', '08/24', '111', 'Mastercard'),
(12, '4003423147592977', '07/26', '333', 'Visa'),
(12, '4373001234567899', '10/27', '222', 'Visa'),
(12, '5424100322112415', '06/28', '888', 'Mastercard'),
(13, '4539511619543483', '11/25', '512', 'Visa'),
(14, '4189021144445555', '05/26', '213', 'Visa'),
(15, '3531781974829082', '04/30', '982', 'JCB');

-- Nota: L'utente 16 (roberto) NON ha carte associate
