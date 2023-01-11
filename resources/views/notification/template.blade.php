<?php
if($value==1)
{
    return array(
        'name' => 'customer_name',
        'email' => 'email',
        'phone_no' => 'phone_no',
        'created_at' => 'created_date'
    );
}elseif($value==2)
{
    return array(
        'name' => 'customer_name',
        'amount' => 'amount',
        'created_at' => 'created_date'
    );
}elseif($value==3)
{
    return array(
        'name' => 'customer_name',
        'consultant_name' => 'consultant_name',
        'consultant_type' => 'consultant_type',
        'amount' => 'amount',
        'booking_date' => 'booking_date',
        'booking_time' => 'booking_time',
        'slot' => 'slot',
        'Insurance' => 'Insurance',
        'status' => 'status',
        'created_at' => 'created_date'
    );
}elseif($value==4 || $value==5 || $value==6 || $value==7 || $value==8 || $value==9)
{
    return array(
        'name' => 'customer_name',
        'booking_id' => 'booking_id',
        'consultant_name' => 'consultant_name',
        'consultant_type' => 'consultant_type',
        'amount' => 'amount',
        'booking_date' => 'booking_date',
        'booking_time' => 'booking_time',
        'slot' => 'slot',
        'Insurance' => 'Insurance',
        'status' => 'status',
        'created_at' => 'created_date'
    );
}
elseif($value==10 || $value==11)
{
    return array(
        'name' => 'customer_name',
        'booking_id' => 'booking_id',
        'consultant_name' => 'consultant_name',
        'consultant_type' => 'consultant_type',
        'amount' => 'amount',
        'booking_date' => 'booking_date',
        'booking_time' => 'booking_time',
        'slot' => 'slot',
        'Insurance' => 'Insurance',
        'status' => 'status',
        'created_at' => 'created_date',
        'rating' => 'rating',
        'review' => 'review',
        
    );
}
elseif($value==12)
{
    return array(
        'name' => 'customer_name',
        'booking_id' => 'booking_id',
        'consultant_name' => 'consultant_name',
        'consultant_type' => 'consultant_type',
        'amount' => 'amount',
        'booking_date' => 'booking_date',
        'booking_time' => 'booking_time',
        'slot' => 'slot',
        'Insurance' => 'Insurance',
        'status' => 'status',
        'created_at' => 'created_date',
        'rating' => 'rating',
        'review' => 'review',
    );
}
elseif($value==13)
{
    return array(
        'name' => 'customer_name',
        'booking_id' => 'booking_id',
        'consultant_name' => 'consultant_name',
        'consultant_type' => 'consultant_type',
        'amount' => 'amount',
        'booking_date' => 'booking_date',
        'booking_time' => 'booking_time',
        'slot' => 'slot',
        'Insurance' => 'Insurance',
        'status' => 'status',
        'created_at' => 'created_date',
        'rating' => 'rating',
        'review' => 'review',
    );
}


?>