import { contextBridge, ipcRenderer } from 'electron';

contextBridge.exposeInMainWorld(
    'api',{
        listar : () => ipcRenderer.invoke('usuario:listar'),
        cadastrar: (usuario) => ipcRenderer.invoke('usuario:cadastrar', usuario)
    }
)