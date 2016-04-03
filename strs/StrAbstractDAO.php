<?php
$str_abs_dao = "<?php
namespace DAO;


abstract class AbstractDAO extends Connection{


    private \$tableName;
    private \$PK;
    private \$strSql;


    public function tolist(\$filters=false, \$order=false, \$pagination){

       \$sql = \"SELECT * FROM `{\$this->getTableName()}` \";
        \$sql .= \$this->prepareSql(\$filters,\$order,\$pagination);
        \$this->setStrSql(\$sql);
        \$stmt = \$this->getCon()->query(\$sql);

        if(\$stmt != FALSE){
            \$row = \$stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach(\$row as \$item){
                \$rs[] =\$this->hydrate(\$item);
            }
             return \$rs;
        } else {
            return false;
        }
    }

    public function toinsert(\$entity){

        \$sql = 'INSERT INTO `'.\$this->getTableName().'` ';

        \$data = \$this->populate(\$entity);

        foreach (\$data as \$key => \$value) {

            \$columns[] = '`'.\$key.'`';
            \$values[] = \"'\".\$value.\"'\";
        }

        \$sql .= \"(\".implode(',',\$columns).\")\";
        \$sql .= \" VALUES (\".implode(',',\$values).\")\";
        \$stmt = \$this->getCon()->prepare(\$sql);
        \$this->setStrSql(\$sql);
        \$return = \$stmt->execute();

        if(\$return != FALSE){

            return true;
        } else {
            return false;
        }
    }

    function todelete(\$id){
        \$sql = \"DELETE FROM `{\$this->getTableName()}` WHERE {\$this->getPK()} = '{\$id}'\";
        \$stmt = \$this->getCon()->prepare(\$sql);
        \$this->setStrSql(\$sql);
        \$return = \$stmt->execute();

        if(\$return != FALSE){

            return true;
        } else {
            return false;
        }
    }

    function toget(\$id){
        \$sql = \"SELECT * FROM `{\$this->getTableName()}` WHERE {\$this->getPK()} = '{\$id}'\";
        \$this->setStrSql(\$sql);
        \$stmt = \$this->getCon()->query(\$sql);

        if(\$stmt != FALSE){
            \$row = \$stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach(\$row as \$item){
                \$rs=\$this->hydrate(\$item);
            }
             return \$rs;
        } else {
            return false;
        }
    }


    function toedit(\$entity){
        \$sql = \"UPDATE `{\$this->getTableName()}` SET \";
        \$data = \$this->populate(\$entity);
        \$i=1;

        foreach (\$data as \$key => \$value) {

            if(\$value != ''){
                \$sql .= \$key . \"='\" . \$value .\"'\";

                if(\$i < (sizeof(\$data))){
                    \$sql .=', ';
                }
            }
            \$i++;
        }
        \$sql .=\" WHERE {\$this->getPK()} = '{\$entity->getId()}'\";

        \$this->setStrSql(\$sql);

        \$stmt = \$this->getCon()->prepare(\$sql);
        \$return = \$stmt->execute();

        if(\$return != FALSE){

            return true;
        } else {
            return false;
        }

    }

    function populate(\$entity){
        return \$row;
    }

    public function hydrate(\$row){
        return \$entity;
    }

    public function prepareSql(\$filters = Array(), \$order = Array(), \$pagination  = Array()){
        if(!empty(\$filters)){
            \$where = true;
            \$i=1;
            foreach (\$filters as \$key => \$value) {
                if(\$value != '' && \$where == true){
                    \$sql.= 'WHERE ';
                    \$where = false;
                }
                if(\$value != ''){

                    \$sql.= \$key.'='.\"'\".\$value.\"'\";

                    if(\$i != sizeof(\$filters)){
                        \$sql.=' AND ';
                    }
                }

                \$i++;
            }
        }

        if(\$order != ''){
            \$sql .= ' ORDER BY '.\$order;
        }

        return \$sql;
    }

    public function getPK()
    {
        return \$this->PK;
    }

    public function setPK(\$id)
    {
        \$this->PK = \$id;
        return \$this;
    }
    public function getTableName()
    {
        return \$this->tableName;
    }

    public function setTableName(\$tableName)
    {
        \$this->tableName = \$tableName;
        return \$this;
    }
    public function getStrSql()
    {
        return \$this->strSql;
    }

    public function setStrSql(\$strSql)
    {
        \$this->strSql = \$strSql;
        return \$this;
    }

    }"
;
