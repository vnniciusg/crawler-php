## **Objetivo**
Desenvolver um webcrawler em PHP para extrair informações de lotes do site solicitado, e criar um arquivo CSV contendo os links capturados, datas do primeiro e segundo leilão, e os preços de cada um.

## **Tecnologias Utilizadas**

1.   PHP 8.2.14
2.   PhpSpreadsheet 1.29.0
3.   Symfony 7.0.0

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


## Utils

   Para encontrar o id do container
   
   ```bash
   docker ps -a
