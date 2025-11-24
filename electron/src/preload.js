import { contextBridge, ipcRenderer } from 'electron';

contextBridge.exposeInMainWorld(
    'api',{
        listar : () => ipcRenderer.invoke('Usuario:listar'),
        cadastrar: (usuario) => ipcRenderer.invoke('Usuario:cadastrar', usuario)
    }
)