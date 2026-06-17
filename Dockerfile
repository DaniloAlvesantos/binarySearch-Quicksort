FROM python

WORKDIR /algorithms

COPY algorithms/ .

RUN pip install --no-cache-dir -r requirements.txt

RUN mkdir -p /algorithms/output

CMD ["python", "main.py"]