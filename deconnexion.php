<?php
                session_destroy();
                session_unset();
                unset($_SESSION["loggedin"]);
                $_SESSION = array();
                ?>