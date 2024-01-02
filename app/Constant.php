<?php
namespace App;
class Constant
{
    const ROLE_ADMIN = 1;
    const ROLE_MERCHANT = 2;
    const ROLE_EMPLOYEE = 3;
    const ROLE_CUSTOMER = 4;
    const ORDER_PENDING = 1;
    const ORDER_SHIPPING = 2;
    const ORDER_CONFIRMED = 3;
    const ORDER_PAID = 4;
    const ORDER_CANCEL = 5;
    const CART_INACTIVE = 0;
    const CART_ACTIVE = 1;
}