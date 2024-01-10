

## **Tecnologias Utilizadas**

1.   PHP
2.   PhpSpreadsheet
3.   Symfony

## **Instruções de Uso**

## Docker(Recomendado)
1. **Construir a Imagem Docker:**
   
   ```bash
   docker build -t webcrawler-php .
    ```
2. **Executar o Container:**
   
   ```bash
   docker run webcrawler-php
    ```

3. **Copiar Dados do Contêiner:**

   Substitua {container_id} pelo ID do contêiner que executou o webcrawler.
   
   ```bash
   docker cp {container_id}:/app/data/ .
    ```
   
## Alternativa sem Docker:
1. **Instalar Dependencias:**
   
   ```bash
   composer install
    ```
2. **Executar o Webcrawler:**
   
   ```bash
   php src/webcrawler.php
    ```
