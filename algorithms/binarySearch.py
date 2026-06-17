def binarySearch(arr, x):
    low = 0
    high = len(arr) - 1

    while low <= high:
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

lista = [1,2,3,3,4,5,6,7,8,9]

print(binarySearch(lista, 7))