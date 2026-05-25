<?php

if (!function_exists('e')) {
    function e($str)
    {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('getDropdownList')) {
    function getDropdownList($table, $columns)
    {
        $CI		=& get_instance();
        $query	= $CI->db->select($columns)->from($table)->get();

        if ($query->num_rows() >= 1) {
            $option1	= ['' => '- Select -'];
            $option2	= array_column($query->result_array(), $columns[1], $columns[0]);
            $options	= $option1 + $option2;

            return $options;
        }

        return $options	= ['' => '- Select -'];
    }
}

if (!function_exists('getCategories')) {
    function getCategories($type = null)
    {
        $CI =& get_instance();
        if ($type) {
            $CI->db->distinct()->select('category.*')
                ->join('product', 'category.id = product.id_category')
                ->where('product.type', $type)
                ->where('product.delete', 1);
        }
        $query = $CI->db->get('category')->result();
        return $query;
    }
}

if (!function_exists('genderLabel')) {
    function genderLabel($code)
    {
        $labels = ['L' => 'Men', 'W' => 'Women', 'U' => 'Unisex'];
        return $labels[$code] ?? 'All';
    }
}

if (!function_exists('getCart')) {
    function getCart()
    {
        $CI =& get_instance();
        $userId = $CI->session->userdata('id');

        if ($userId) {
            $query = $CI->db->where('id_user', $userId)->count_all_results('cart');
            return $query;
        }

        return false;
    }
}

if (!function_exists('hashEncrypt')) {
    function hashEncrypt($input)
    {
        return password_hash($input, PASSWORD_DEFAULT);
    }
}

if (!function_exists('hashEncryptVerify')) {
    function hashEncryptVerify($input, $hash)
    {
        return password_verify($input, $hash);
    }
}

if (!function_exists('calculateDiscount')) {
    function calculateDiscount($subtotal)
    {
        $discountPercentage = 0;

        if ($subtotal > 500000) {
            $discountPercentage = 20;
        } elseif ($subtotal > 200000) {
            $discountPercentage = 10;
        }

        $discountAmount = ($discountPercentage / 100) * $subtotal;

        return [
            'percentage' => $discountPercentage,
            'amount' => $discountAmount,
            'total' => $subtotal - $discountAmount,
        ];
    }
}

if (!function_exists('getRajaOngkirProvinces')) {
    function getRajaOngkirProvinces()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "key: b89355f9434e0df1e842c84906a52cb5"
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}

if (!function_exists('formatRupiah')) {
    function formatRupiah($number)
    {
        return number_format($number, 0, ',', '.');
    }
}