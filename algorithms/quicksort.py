def quicksort(arr, left, right):
    # Se left nao for menor que right chegamos ao fim da lista
    if left < right:
        pivot = partition(arr, left, right)

        quicksort(arr, left, pivot-1)
        quicksort(arr, pivot+1, right)

def partition(arr, left, right):
    pivot = arr[right]
    i = left - 1

    for j in range(left, right):
        if arr[j] <= pivot:
            i += 1
            arr[i], arr[j] = arr[j], arr[i]
    
    # Coloca o pivot na posição certa
    arr[i+1], arr[right] = arr[right], arr[i+1]
    
    # Retonar a posição do pivot
    return i + 1

lista = [3,2,1,0,4,7,9,8,6,5]

quicksort(lista, 0, len(lista) - 1)
print(lista)