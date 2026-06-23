import os
import time
import psutil
from quicksort import quicksort as intSort  
import quicksort
from binarySearch import binarySearch as byNumber  
import binarySearch


def get_process_memory():
    process = psutil.Process(os.getpid())
    return process.memory_info().rss / (1024 * 1024)

def benchmark_quicksort(arr_to_sort):
    list_copy = arr_to_sort.copy()

    quicksort.quicksort_iterations = 0

    mem_antes = get_process_memory()
    psutil.cpu_percent(interval=None) 

    start_time = time.perf_counter()
    intSort(list_copy, 0, len(list_copy) - 1)
    end_time = time.perf_counter()
    
    cpu_uso = psutil.cpu_percent(interval=None)
    mem_depois = get_process_memory()

    execution_time = end_time - start_time
    total_iterations = quicksort.quicksort_iterations
    memoria_alocada = max(0.0, mem_depois - mem_antes)

    return list_copy, execution_time, total_iterations, memoria_alocada, cpu_uso

def benchmark_binary_search(arr, target):
    binarySearch.binarysearch_iterations = 0

    mem_antes = get_process_memory()
    psutil.cpu_percent(interval=None)

    start_time = time.perf_counter()
    index_found = byNumber(arr, target)
    end_time = time.perf_counter()

    cpu_uso = psutil.cpu_percent(interval=None)
    mem_depois = get_process_memory()

    execution_time = end_time - start_time
    total_iterations = binarySearch.binarysearch_iterations
    memoria_alocada = max(0.0, mem_depois - mem_antes)

    return index_found, execution_time, total_iterations, memoria_alocada, cpu_uso

def exec_metrics_quicksort(arr_to_sort):
    print("\n--- Executando Métricas: Quicksort ---")
    result, duration, iterations, memory, cpu = benchmark_quicksort(arr_to_sort)
    print(f"Tamanho do Array processado: {len(result)} elementos")
    print(f"Iterações executadas: {iterations}")
    print(f"Tempo de execução: {duration:.8f} segundos")
    print(f"Memória consumida: {memory:.4f} MB")
    print(f"Uso de CPU: {cpu}%")
    return {"sorted_arr": result, "time": duration, "iterations": iterations, "memory": memory, "cpu": cpu}

def exec_metrics_binarySearch(sorted_arr, target):
    print(f"\n--- Executando Métricas: Busca Binária (Alvo: {target}) ---")
    index, duration, iterations, memory, cpu = benchmark_binary_search(sorted_arr, target)
    if index != -1:
        print(f"Elemento localizado com sucesso no índice: {index}")
    else:
        print("Elemento não foi encontrado no array.")
    print(f"Iterações executadas: {iterations}")
    print(f"Tempo de busca: {duration:.8f} segundos")
    print(f"Memória consumida: {memory:.4f} MB")
    print(f"Uso de CPU: {cpu}%")
    return {"index": index, "time": duration, "iterations": iterations, "memory": memory, "cpu": cpu}