import time
from quicksort import quicksort as intSort  
import quicksort
from binarySearch import binarySearch as byNumber  
import binarySearch

def benchmark_quicksort(arr_to_sort):
    list_copy = arr_to_sort.copy()

    quicksort.quicksort_iterations = 0

    start_time = time.perf_counter()
    intSort(list_copy, 0, len(list_copy) - 1)
    end_time = time.perf_counter()
    
    execution_time = end_time - start_time

    total_iterations = quicksort.quicksort_iterations

    return list_copy, execution_time, total_iterations

def benchmark_binary_search(arr, target):
    binarySearch.quicksort_iterations = 0

    start_time = time.perf_counter()
    index_found = byNumber(arr, target)
    end_time = time.perf_counter()

    execution_time = end_time - start_time

    total_iterations = binarySearch.binarysearch_iterations

    return index_found, execution_time, total_iterations

def exec_metrics_quicksort(arr_to_sort):
    print("\n--- Executando Métricas: Quicksort ---")
    result, duration, iterations = benchmark_quicksort(arr_to_sort)
    print(f"Tamanho do Array processado: {len(result)} elementos")
    print(f"Iterações executadas: {iterations}")
    print(f"Tempo de execução: {duration:.8f} segundos")
    return {"sorted_arr": result, "time": duration, "iterations": iterations}

def exec_metrics_binarySearch(sorted_arr, target):
    print(f"\n--- Executando Métricas: Busca Binária (Alvo: {target}) ---")
    index, duration, iterations = benchmark_binary_search(sorted_arr, target)
    if index != -1:
        print(f"Elemento localizado com sucesso no índice: {index}")
    else:
        print("Elemento não foi encontrado no array.")
    print(f"Iterações executadas: {iterations}")
    print(f"Tempo de busca: {duration:.8f} segundos")
    return {"index": index, "time": duration, "iterations": iterations}