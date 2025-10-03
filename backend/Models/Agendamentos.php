<?php 

namespace App\Tadala\Models;
use PDO;

    Class Agendamentos{
        private $db;
        private $agendamento_id;
        private $usuario_id;
        private $mesa_id;
        private $data_hora_inicio;
        private $data_hora_fim;
        private $criado_em;
        private $atualizado_em;
        private $excluido_em;

        public function __construct($db){
            $this->db = $db;
        }
        function BuscarAgendamento(){
            $sql = "SELECT agendamento_id as 'ID', usuario_id as 'Usuario ID', mesa_id as 'Mesa ID', data_hora_inicio as 'Data Hora Inicio', data_hora_fim as 'Data Hora Fim', criado_em as 'Criado Em', atualizado_em as 'Atualizado Em', excluido_em as 'Excluido Em' FROM tbl_agendamento where excluido_em is null";
            $stmt = $this->db->query($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        function BuscarAgendamentoPorid($id){
            $sql = "SELECT agendamento_id as 'ID', usuario_id as 'Usuario ID', mesa_id as 'Mesa ID', data_hora_inicio as 'Data Hora Inicio', data_hora_fim as 'Data Hora Fim', criado_em as 'Criado Em', atualizado_em as 'Atualizado Em', excluido_em as 'Excluido Em' FROM tbl_agendamento WHERE agendamento_id = :id and excluido_em is null";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        function InserirAgendamento($data_hora_inicio,$data_hora_fim,$usuario_id,$mesa_Id){
            $sql = 'INSERT INTO tbl_agendamento (data_hora_inicio, data_hora_fim,usuario_id,mesa_id) VALUES (:data_hora_inicio, :data_hora_fim,:usuario_id,:mesa_id)';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':data_hora_inicio', $data_hora_inicio);
            $stmt->bindParam(':data_hora_fim', $data_hora_fim);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->bindParam(':mesa_id', $mesa_Id);
            $stmt->execute();
            return $this->db->lastInsertId();
        }

        function DeletarAgendamento ($id){
            $sql = 'UPDATE tbl_agendamento SET excluido_em = NOW() WHERE agendamento_id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        }


    }