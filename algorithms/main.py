import random
import json
import os
import sys
import pandas as pd

sys.setrecursionlimit(2000000)

from metrics import exec_metrics_quicksort, exec_metrics_binarySearch

try:
    from graph import gerar_graficos
except ImportError:
    def gerar_graficos(df): pass

os.makedirs("output", exist_ok=True)

num_range = 1000000
random_nums = [random.randint(1, num_range) for _ in range(num_range)]


quicksort_data = exec_metrics_quicksort(random_nums)
sorted_random_nums = quicksort_data["sorted_arr"]

target = random_nums[random.randint(0, len(random_nums) - 1)]
binary_data = exec_metrics_binarySearch(sorted_random_nums, target)

results_data = [
    {
        'algorithm': 'Quicksort',
        'time_s': quicksort_data["time"],
        'iterations': quicksort_data["iterations"]
    },
    {
        'algorithm': 'Busca Binaria',
        'time_s': binary_data["time"],
        'iterations': binary_data["iterations"]
    }
]

df = pd.DataFrame(results_data)
df.to_csv("output/metrics.csv", index=False)

summary = {
    'input_size': len(random_nums),
    'target': int(target),
    'target_result_index': int(binary_data["index"]),
    'quicksort_time_s': round(quicksort_data["time"], 6),
    'binary_search_time_s': round(binary_data["time"], 6),
    'avg_time_s': round(df['time_s'].mean(), 6)
}

with open("output/metrics.json", "w") as file:
    json.dump(summary, file, indent=4, ensure_ascii=False)

print("\nResultados Consolidados:")
print(df)

gerar_graficos(df)

print("\nGenerated Files in /output")
print("- metrics.csv")
print("- metrics.json")
print("- performance_graph_normal.png (Busca binária invisível)")
print("- performance_graph_log.png    (Visualização perfeita)")
print("- iterations_graph_normal.png  (Busca binária invisível)")
print("- iterations_graph_log.png     (Visualização perfeita)")

print("\nExecução concluída.")