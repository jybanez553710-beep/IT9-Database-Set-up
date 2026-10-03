-- Sample data matching the screenshots.
-- Run AFTER schema.sql. Safe to re-run: it clears the transaction tables first.
-- Services and tools are NOT re-inserted (schema.sql already does that);
-- this file only updates tool stock and adds clients/bookings/payments.
USE assessment_db;

TRUNCATE TABLE payments;
TRUNCATE TABLE booking_tools;
TRUNCATE TABLE bookings;
TRUNCATE TABLE clients;

-- Clients (placeholder names - not shown in the screenshots)
INSERT INTO clients (client_id, full_name, email, phone, address) VALUES
(1, 'Juan Dela Cruz', 'juan@example.com', '09171234567', 'Davao City'),
(2, 'Maria Santos',   'maria@example.com', '09181234567', 'Davao City');

-- Bookings: #2 = Electrical x 1 hr = 600.00, fully paid (matches Process Payment screen)
INSERT INTO bookings
(booking_id, client_id, service_id, booking_date, hours, hourly_rate_snapshot, total_cost, status) VALUES
(1, 1, (SELECT service_id FROM services WHERE service_name='Plumbing'),   '2026-10-01', 1, 500.00, 500.00, 'PENDING'),
(2, 2, (SELECT service_id FROM services WHERE service_name='Electrical'), '2026-10-02', 1, 600.00, 600.00, 'PAID');

-- Payment: booking #2 paid in full -> Total Paid 600.00, Balance 0.00
INSERT INTO payments (booking_id, amount_paid, method) VALUES
(2, 600.00, 'CASH');

-- Tools in use: Hammer 10 of 10, Ladder 2 of 3 (matches Tools screen)
INSERT INTO booking_tools (booking_id, tool_id, qty_used) VALUES
(1, (SELECT tool_id FROM tools WHERE tool_name='Hammer'), 5),
(2, (SELECT tool_id FROM tools WHERE tool_name='Hammer'), 5),
(1, (SELECT tool_id FROM tools WHERE tool_name='Ladder'), 1),
(2, (SELECT tool_id FROM tools WHERE tool_name='Ladder'), 1);

UPDATE tools SET quantity_available = 0 WHERE tool_name='Hammer';
UPDATE tools SET quantity_available = 1 WHERE tool_name='Ladder';
UPDATE tools SET quantity_available = 5 WHERE tool_name='Power Drill';
