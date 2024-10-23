import tkinter as tk

root = tk.Tk()

#Caratceristicas de la ventana principal
root.title("Gestor de archivos")
root.geometry("300x300")
root.configure(background="red")

#Metodos de la ventana
def saludar():
    print("Seleccione un archivo")

def mostrar():
    print("Seleccione un archivo para eliminar")

#Controles de la ventana
label1 = tk.Label(root, text="Bienvenido a Dust in the Wind")
label1.pack(pady=5)
label1.pack(padx=2)
label1.config(background="blue",borderwidth=2, font="Arial")
boton1 = tk.Button(root, text="Seleccionar archivo", command=saludar)
boton1.pack(pady=5)
boton2 = tk.Button(root, text="Borrar archivo", command=mostrar)
boton2.pack(pady=5)

root.mainloop()