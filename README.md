# Biblioteca Alejandría
Plataforma dedicada a la literatura, organizando libros por género y autor para una experiencia de lectura más placentera.

En nuestra plataforma, los usuarios pueden sumergirse en el vasto universo de los libros, meticulosamente organizados según su género literario y/o autor. Esto simplificará la búsqueda de obras que se ajusten a las preferencias de cada lector. Para aquellos interesados en adquirir un libro, nuestra plataforma proporciona información detallada que incluye sinopsis consisas, las cuales ofrecen una visión general de la trama y el contenido. Los lectores ya no deberán preocuparse por perder la página en la que estaban leyendo, pues aquí se registrará el progreso y última visita, proporcionando así una experiencia más enriquecedora al usuario. En pocas palabras, nuestra plataforma, "Biblioteca Alejandría", se presenta como un recurso para los amantes de la literatura.

# Integrantes
Rio, Gustavo Nahuel (riogustavo2001@gmail.com)
López Vilaclara, Milagros (lopezvmilagros@gmail.com)
# Descripción de Endpoints
Obtener Todas las Sugerencias
# Endpoint: /suggestions

# Método: GET

Descripción:
Este endpoint devuelve todas las sugerencias almacenadas en la base de datos.

Respuesta Exitosa:

// Ejemplo de respuesta exitosa
[
  {
    "id": 1,
    "titulo": "Ejemplo 1",
    "genero": "Comedia",
    "descripcion": "Descripción de la sugerencia 1",
    "prioridad": 1
  },
  // Otros objetos de sugerencias
]
Respuesta de Error:

// Ejemplo de respuesta de error
{
  "error": "Mensaje de error detallado"
}
Obtener una Sugerencia por ID
# Endpoint: /suggestions/{id}

# Método: GET

Descripción:
Este endpoint devuelve una sugerencia específica según el ID proporcionado.

Respuesta Exitosa:

// Ejemplo de respuesta exitosa
{
  "id": 1,
  "titulo": "Ejemplo 1",
  "genero": "Comedia",
  "descripcion": "Descripción de la sugerencia 1",
  "prioridad": 1
}
Respuesta de Error:

// Ejemplo de respuesta de error
{
  "error": "Mensaje de error detallado"
}
Insertar una Nueva Sugerencia
# Endpoint: /suggestions

# Método: POST

Descripción:
Este endpoint inserta una nueva sugerencia en la base de datos. Se requieren los siguientes parámetros en el cuerpo de la solicitud:

{
    "titulo": "Ejemplo de Título",
    "genero": "Ejemplo de Género",
    "descripcion": "Ejemplo de Descripción",
    "prioridad": 1
}
Respuesta Exitosa:

// Ejemplo de respuesta exitosa
{
  "id": 1
}
Respuesta de Error:

// Ejemplo de respuesta de error
{
  "error": "Mensaje de error detallado"
}
Eliminar una Sugerencia por ID
# Endpoint: /suggestions/{id}

# Método: DELETE

Descripción:
Este endpoint elimina una sugerencia específica según el ID proporcionado.

Respuesta Exitosa:
Sin contenido (204 No Content)

Respuesta de Error:

// Ejemplo de respuesta de error
{
  "error": "Mensaje de error detallado"
}
Actualizar Datos de una Sugerencia por ID
# Endpoint: /suggestions/{id}

# Método: PUT o PATCH

Descripción:
Este endpoint modifica los datos de una sugerencia según el ID proporcionado. Se requieren los siguientes parámetros en el cuerpo de la solicitud:

{
    "titulo": "Nuevo Título",
    "genero": "Nuevo Género",
    "descripcion": "Nueva Descripción",
    "prioridad": 2
}
Respuesta Exitosa:
Sin contenido (204 No Content)

Respuesta de Error:

// Ejemplo de respuesta de error
{
  "error": "Mensaje de error detallado"
}
