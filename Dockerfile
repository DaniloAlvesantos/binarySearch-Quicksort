FROM python:3.11-slim

WORKDIR /app

COPY algorithms/requirements.txt ./

RUN pip install --no-cache-dir -r requirements.txt

COPY algorithms/ .

RUN mkdir -p /app/output

CMD ["python", "main.py"]