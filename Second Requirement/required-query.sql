-- --------------------required query----------------------
SELECT C.customer_name, O.order_id, O.order_date, O.amount FROM customers C, orders O WHERE C.customer_id = O.customer_id AND O.order_date >= ( CURDATE() - INTERVAL 10 DAY ) AND (C.customer_name = 'ABC' or C.customer_name = 'XYZ')

