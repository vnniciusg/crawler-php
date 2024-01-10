
## **Instruções de Uso**

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
   
