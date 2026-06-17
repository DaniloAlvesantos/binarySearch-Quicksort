import random
import json
import pandas as pd

from algorithms.metrics import exec_metrics_quicksort, exec_metrics_binarySearch
from algorithms.graph import gerar_graficos

results = []
random_nums = [random.randint(1, 100) for _ in range(100)]

print("\nRandom Numbers:")
print(random_nums)

sorted_random_nums = []

quicksort_result = exec_metrics_quicksort(random_nums)
results.append(quicksort_result)
sorted_random_nums = quicksort_result["result"]

print("\nSorted Random Numbers:")
print(sorted_random_nums)

target = random_nums[random.randint(0, len(sorted_random_nums) - 1)]
binarySearch_result = exec_metrics_binarySearch(sorted_random_nums, target)
results.append(binarySearch_result)

df = pd.DataFrame(results)

df.to_csv("/algorithms/output.metrics.csv", index=False)

summary = {
    'input': random_nums,
    'input_size': len(random_nums),
    'sorted_input': sorted_random_nums,
    'target': target,
    'target_result': binarySearch_result['result'],
    'avd_time': round(df['time_ms'].mean(), 4),
    'avd_memory': round(df['memory_mb'].mean(), 4),
    'avd_iterations': round(df['iterations'].mean(), 4)
}

with open("/algorithms/output.summary.json", "w") as file:
    json.dump(
        summary,
        file,
        indent=4,
        ensure_ascii=False
    )

print("\nResults:")
print(df)

gerar_graficos(df)

print("\nGenerated Files in /output")
print("- metrics.csv")
print("- metrics.json")
print("- performance_graph.png")
print("- iterations_graph.png")

print("\nExecução concluída.")