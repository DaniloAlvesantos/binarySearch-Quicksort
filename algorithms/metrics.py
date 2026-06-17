import time
import psutil
import os

def benchmark_binarySearch(arr, x):
    low = 0
    high = len(arr) - 1
    iterations = 0
    target = None

    while low <= high:
        iterations += 1
        mid = low + (high - low) // 2

        if arr[mid] == x:
            target = mid
            break
        elif arr[mid] < x:
            low = mid + 1
        else:
            high = mid - 1
    
    if(target == None):
        return -1
    else:
        return target, iterations

def benchmark_quicksort(arr):
    iterations = 0
    def quicksort(arr, left, right):
        nonlocal iterations
        if left < right:
            iterations += 1
            pivot = partition(arr, left, right)

            quicksort(arr, left, pivot-1)
            quicksort(arr, pivot+1, right)

        return arr, iterations

    def partition(arr, left, right):
        pivot = arr[right]
        i = left - 1

        for j in range(left, right):
            if arr[j] <= pivot:
                i += 1
                arr[i], arr[j] = arr[j], arr[i]
        
        arr[i+1], arr[right] = arr[right], arr[i+1]
        
        return i + 1

def exec_metrics_quicksort(list):
    process = psutil.Process(os.getpid())
    prev_memory = process.memory_info().rss / 1024 / 1024

    start_time = time.perf_counter()

    result, iterations = benchmark_quicksort(list)

    end_time = time.perf_counter()
    elapsed_time = round((end_time - start_time) * 1000, 6)

    current_memory = process.memory_info().rss / 1024 / 1024 
    memory_usage = round(current_memory - prev_memory, 6)

    return {
        'input': list,
        'result': result,
        'time_ms': elapsed_time,
        'memory_mb': memory_usage,
        'iterations': iterations
    }

def exec_metrics_binarySearch(list, n):
    process = psutil.Process(os.getpid())
    prev_memory = process.memory_info().rss / 1024 / 1024

    start_time = time.perf_counter()

    result, iterations = benchmark_binarySearch(list, n)

    end_time = time.perf_counter()
    elapsed_time = round((end_time - start_time) * 1000, 6)

    current_memory = process.memory_info().rss / 1024 / 1024 
    memory_usage = round(current_memory - prev_memory, 6)

    return {
        'input': list,
        'target': n,
        'result': result,
        'time_ms': elapsed_time,
        'memory_mb': memory_usage,
        'iterations': iterations
    }