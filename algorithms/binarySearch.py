binarysearch_iterations = 0

def binarySearch(arr, x):
    global binarysearch_iterations
    low = 0
    high = len(arr) - 1

    while low <= high:
        binarysearch_iterations += 1
        mid = low + (high - low) // 2

        if arr[mid] == x:
            return mid
        elif arr[mid] < x:
            # Se o valor central for menor que x, descarta o lado esquerdo
            low = mid + 1
        else:
            # Se o valor central for maior que x, descartamos o lado direito
            high = mid - 1
    
    return -1