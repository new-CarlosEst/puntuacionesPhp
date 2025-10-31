# Practica de tabla puntuaciones

# Carlos Esteban Diez 2 DAW

# Añadidos
- En vez de cargarme el sql arrastandolo me lo cargo en conexionBBDD.php cada vez que hago una conexion

## Importante 
- Al clonar/descargar/usar el proyecto es importante instalarse la liberia para manejar .env con composer (En mi caso he usado la liberia de lucasv/phpdotenv)
- La conexion a la base de datos (contraseña, servicio, usuario y base de datos que se va a usar) se saca todo el un .env, ademas de que no esta la carpeta vendor que es la que gestiona todas las liberias php instaladas
- Ademas es importante tener instalada la liberia PDO para manejar la DB de donde se sacan los datos