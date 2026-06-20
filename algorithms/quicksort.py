quicksort_iterations = 0

def quicksort(arr, left, right):
    if left < right:
        pivot_index = partition(arr, left, right)
        
        quicksort(arr, left, pivot_index - 1)
        quicksort(arr, pivot_index + 1, right)

def partition(arr, left, right):
    global quicksort_iterations
    pivot = arr[right]
    i = left - 1

    for j in range(left, right):
        quicksort_iterations += 1
        
        if arr[j] <= pivot:
            i += 1
            arr[i], arr[j] = arr[j], arr[i]

    arr[i + 1], arr[right] = arr[right], arr[i + 1]
    return i + 1