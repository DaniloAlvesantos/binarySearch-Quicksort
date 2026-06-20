import matplotlib.pyplot as plt

def gerar_graficos(df):
    plt.figure(figsize=(8, 5))
    plt.bar(
        df["algorithm"], 
        df["time_s"], 
        color=["#4f46e5", "#0ea5e9"], 
        width=0.4
    )
    plt.title("Tempo de Execução — Escala Normal (Linear)")
    plt.xlabel("Algoritmo")
    plt.ylabel("Tempo (segundos)")
    plt.grid(axis='y', linestyle='--', alpha=0.7)
    plt.savefig("output/performance_graph_normal.png")
    plt.close()

    plt.figure(figsize=(8, 5))
    plt.bar(
        df["algorithm"], 
        df["time_s"], 
        color=["#4f46e5", "#0ea5e9"], 
        width=0.4
    )
    plt.yscale('log') 
    plt.title("Tempo de Execução — Escala Logarítmica")
    plt.xlabel("Algoritmo")
    plt.ylabel("Tempo (segundos - Escala Log)")
    plt.grid(axis='y', linestyle='--', alpha=0.5, which="both")
    plt.savefig("output/performance_graph_log.png")
    plt.close()


    plt.figure(figsize=(8, 5))
    plt.bar(
        df["algorithm"], 
        df["iterations"], 
        color=["#f59e0b", "#10b981"], 
        width=0.4
    )
    plt.title("Quantidade de Iterações — Escala Normal (Linear)")
    plt.xlabel("Algoritmo")
    plt.ylabel("Contagem de Iterações")
    plt.grid(axis='y', linestyle='--', alpha=0.7)
    plt.savefig("output/iterations_graph_normal.png")
    plt.close()

    plt.figure(figsize=(8, 5))
    plt.bar(
        df["algorithm"], 
        df["iterations"], 
        color=["#f59e0b", "#10b981"], 
        width=0.4
    )
    plt.yscale('log')
    plt.xlabel("Algoritmo")
    plt.ylabel("Iterações (Escala Log)")
    plt.grid(axis='y', linestyle='--', alpha=0.5, which="both")
    plt.savefig("output/iterations_graph_log.png")
    plt.close()