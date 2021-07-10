<?php
class Criptografar {
    private function generate_salt() {
        // Gera um salt aleatório baseado no ramdom_bytes e cortando
        // em 22 caracteres
        $salt = base64_encode(random_bytes(22));
        $salt = substr($salt, 0, 22);
        return strtr($salt, '+', '.');
    }

    public function encriptar($password) {
        // Encripta uma senha com base no algoritimo bycripty
        $cost = '09';
        $salt = $this->generate_salt();
        $hash = crypt($password, '$2a$'.$cost.'$'.$salt.'$');
        return $hash;
    }

    public function validar_senha($password, $hash) {
        return (crypt($password, $hash) === $hash);
    }
  }

