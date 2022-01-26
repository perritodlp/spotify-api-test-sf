### Prueba técnica para desarrollador Web.

Se llevan a cabo las actividades para la evaluación técnica de ingreso a la compañía. 

Se verifica en entorno local, el cumplimiento de los criterios de evaluación.

La prueba se lleva a cabo, usando:

- El framework de PHP Symfony versión 5.2. 
- Flexbox para los estilos y el responsive.
- Vanilla JavaScript para la interacción con la ventana modal.
- Docker para gestionar el desarrollo en el ambiente local.
- Nginx como servidor web.
### :cloud: Clonando el proyecto desde Github

```bash
# Desde la terminal, cambiarse al directorio donde se clonará el repositorio, de acuerdo al sistema operativo. Por ejemplo, en MacOs:
cd ~/ruta-deseada/

# Clonar el repositorio
git clone https://github.com/perritodlp/spotify-api-test-sf.git

```

### :construction: Instalación del ambiente del proyecto


```bash
# Es necesario tener PHP 7+ instalado en el equipo de computo.

# Cambiarse a la ruta usando la terminal
cd spotify-api-test-sf

# Crear en la raíz el archivo .env con la información en el correo o copiar el archivo adjunto al correo,
# ya que proporciona la configuración del aplicativo. 

# Teniendo instalado Composer en el equipo, ejecutar el comando
composer install

# Una vez finalizado el paso anterior y estando dentro del mismo directorio, ejecutar 
php -S 127.0.0.1:8000 -t public/

```

### :alien: Visualización
```bash
# Abrir una pestaña de navegador, abrir la siguiente dirección y probar:
http://localhost:8000/

# La primera vez será llevado a la página de login social de Spotify donde deberá ingresar el usuario y la contraseña. Luego debería ser redireccionado a:
http://localhost:8000/lanzamientos

```

### :ambulance: Asuntos varios

- <p style="text-align: justify;">Para la autenticación contra la API de Spotify, se usó el método de autorización de Oauth2 llamado "Authorization Code Flow", el cual hará necesario que la primera vez que se ejecute la aplicación, se tenga que ingresar el usuario y la clave de una cuenta gratuita o paga de Spotify. Esto es debido a que tiene acceso a los scopes donde se requiere consultar información privada del usuario.</p> 

- Para los pocos endpoints que se consumían y que no requerían autorización, ya que no consumían datos privados del usuario de Spotify, se hubiese podido utilizar el flujo "Client Credencial Flow", pero se me presentaron inconvenientes al intentar implementarlo y se optó por dejar el mencionado anteriormente.

- El requerimiento indicaba que se debía diseñar un módulo que cumpliera con la documentación ofrecida. En este punto me asaltó la duda (pero no pregunté!! :anguished:), sobre si se refería a un Bundle para poder ser utilizado en otros proyectos o se refería a un bloque de funcionalidades que llevaran a cabo un cometido. Se ejecuta y se entrega como una página, ya que por falta de tiempo quedé en la mitad de la creación del Bundle, debido a que tuve que buscar información sobre cómo hacerlo (Curso de Symfonycast.com). 

- Prefiero entregar lo que podrán observar y no dejar de mostrar mi trabajo.

- Se deja comentado la mayor parte del código, para la mejor comprensión del mismo.


### :construction_worker: Espero que todo funcione y gracias por la oportunidad brindada!! :fire: 