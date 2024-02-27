<?php

namespace App;

session_start();

abstract class Session
{

    const FLASH = 'FLASH_MESSAGES';

    const FLASH_ERROR = 'danger';
    const FLASH_WARNING = 'warning';
    const FLASH_INFO = 'info';
    const FLASH_SUCCESS = 'success';

    /**
     * la méthode qui nous permet de récupérer l'utilisateur en session
     */
    public static function getUtilisateur()
    {
        if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur'] !== null) {
            return $_SESSION['utilisateur'];
        }
        return false;
    }

    /**
     * Enregistrement de l'utilisateur dans la session
     */
    public static function setUtilisateur($utilisateur)
    {
        $_SESSION['utilisateur'] = $utilisateur;
    }

    /**
     * pour supprimer la session utilisateur
      */ 
    public static function removeUtilisateur()
    {
        if (self::getutilisateur()) {
            unset($_SESSION['utilisateur']);
        }
        return;
    }

    public static function authenticationRequired($roleToHave)
    {
        if (!self::getUtilisateur()) {
            Router::redirectTo("security", "login");
        }
    }
    //generer le token de la session pour le comparer à celui du formulaire
    public static function generateKey()
    {
        if (!isset($_SESSION['key']) || $_SESSION['key'] === null) {
            $_SESSION['key'] = bin2hex(random_bytes(32));
        }
    }

    public static function getKey()
    {
        return $_SESSION['key'];
    }
    public static function herarchie()
    {
        $grades = [
            1 => "<span class='badge badge-pill badge-danger'>ADMIN</span>",
            2 => "<span class='badge badge-pill badge-success''>MODERATEUR</span>",
            3 => "<span class='badge badge-pill badge-primary'>VIP</span>",
            4 => "<span class='badge badge-pill badge-warning'>MEMBRE SENIOR</span>",
            5 => "<span class='badge badge-pill badge-secondary''>MEMBRE</span>"
        ];
        foreach ($grades as $role => $grade) {
            if ($role == self::getUtilisateur()->getRole()) {
                return $grade;
            }
        }
    }

    /**
     * Adding a flash message
     *
     * @param string $name
     * @param string $message
     * @param string $type
     * @return void
     */
    public static function addMessage(string $name, string $message, string $type): void
    {
        // remove existing message with the name
        if (isset($_SESSION[self::FLASH][$name])) {
            unset($_SESSION[self::FLASH][$name]);
        }
            // add the message to the session
            $_SESSION[self::FLASH][$name] = ['message' => $message, 'type' => $type];
    }

    /**
     * Format a flash message
     *
     * @param array $flash_message
     * @return string
     */
    public static function format_flash_message(array $flash_message): string
    {
        return sprintf(
            '<div id="flash-message" class="alert alert-%s">%s</div>',
            $flash_message['type'],
            $flash_message['message']
        );
    }

    /**
     * Display a flash message
     *
     * @param string $name
     * @return void
     */
    public static function  display_flash_message(string $name): void
    {
        if (!isset($_SESSION[self::FLASH][$name])) {
            return;
        }

        // get message from the session
        $flash_message = $_SESSION[self::FLASH][$name];

        // delete the flash message
        unset($_SESSION[self::FLASH][$name]);

        // display the flash message
        echo self::format_flash_message($flash_message);
    }

    /**
     * Display all flash messages
     *
     * @return void
     */
    public static function  display_all_flash_messages(): void
    {
        if (!isset($_SESSION[self::FLASH])) {
            return;
        }

        // get flash messages
        $flash_messages = $_SESSION[self::FLASH];

        // remove all the flash messages
        unset($_SESSION[self::FLASH]);

        // show all flash messages
        foreach ($flash_messages as $flash_message) {
            echo self::format_flash_message($flash_message);
        }
    }

    /**
     * Flash a message
     *
     * @param string $name
     * @param string $message
     * @param string $type (error, warning, info, success)
     * @return void
     */
    public static function flash(string $name = '', string $message = '', string $type = ''): void
    {
        match (true) {
            ($name !== '' && $message !== '' && $type !== '') => self::addMessage($name, $message, $type),
            ($name !== '' && $message === '' && $type === '') => self::display_flash_message($name),
            ($name === '' && $message === '' && $type === '') => self::display_all_flash_messages()
        };
    }
    public static function getValuesOf($index)
    {
        return isset($_SESSION[$index]) ? $_SESSION[$index] : false;
    }
}