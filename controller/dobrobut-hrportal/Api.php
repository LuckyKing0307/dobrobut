<?php

use Datto\JsonRpc\Evaluator;
use Datto\JsonRpc\Exceptions\ArgumentException;
use Datto\JsonRpc\Exceptions\MethodException;

class Api implements Evaluator
{

    protected $pg;

    /**
     * @throws Exception
     */
    function __construct($config)
    {

        $this->pg  = pg_connect($config['PG_CONNECT']) or die("PostgreSQL not connected");
        $stat      = pg_connection_status($this->pg);
        if ($stat !== PGSQL_CONNECTION_OK) {
            throw new Exception("PostgreSQL not connected");
        }
    }

    /**
     * @throws ArgumentException
     * @throws MethodException
     * @throws Exception
     */
    public function evaluate($method, $arguments)
    {
        if ($method === 'organization') {
            return self::setOrganization($arguments);
        } else if ($method === 'position') {
            return self::setPosition($arguments);
        } else if ($method === 'personal_type') {
            return self::setPersonalType($arguments);
        } else if ($method === 'department') {
            return self::setDepartment($arguments);
        } else if ($method === 'personal_direction') {
            return self::setPersonalDirections($arguments);
        } else if ($method === 'user') {
            return self::setUser($arguments);
        } else if ($method === 'getOrganizationList') {
            return self::getOrganizationList();
        } else if ($method === 'getPersonalTypesList') {
            return self::getPersonalTypesList();
        } else if ($method === 'getPersonalDirectionsList') {
            return self::getPersonalDirectionsList();
        } else if ($method === 'getDepartmentList') {
            return self::getDepartmentList();
        } else if ($method === 'getUsersList') {
            return self::getUsersList($arguments);
        } else if ($method === 'getUsersSearch') {
            return self::getUsersSearch($arguments);
        } else if ($method === 'getUsersSearchMain') {
            return self::getUsersSearchMain($arguments);
        } else if ($method === 'getUsersById') {
            return self::getUsersById($arguments);
        } else if ($method === 'getUsersByTyped') {
            return self::getUsersByTyped($arguments);
        } else if ($method === 'getPods') {
            return self::getPods($arguments);
        } else if ($method === 'getOrgtyped') {
            return self::getOrgtyped($arguments);
        } else if ($method === 'getDepList') {
            return self::getDepList($arguments);
        }



        throw new MethodException();
    }

    /**
     * @throws ArgumentException
     * @throws Exception
     */
    private function setOrganization($arguments): array
    {
        $fields = $arguments['fields'];
        if (!is_array($fields)) {
            throw new ArgumentException();
        }

        //$html_utf8 = mb_convert_encoding($html, "utf-8", "windows-1251");

        $result = [];
        foreach ($fields  as $field) {
            $id     = $field['ID'];
            $name   = $field['NAME'];
            $active = $field['ACTIVE'] === 'Y' ? 't' : 'f';

            $res = @pg_query_params($this->pg, 'insert into organizations (id, active, name ) values ($1,$2,$3) on conflict ON CONSTRAINT organizations_pk do update set active=$2, name =$3', [$id,$active,$name]);
            if ($res === false) {
                $result[] = array('id' => $id, 'result' => 'error', 'message' => @pg_last_error($this->pg));
            }
            else {
                $result[] = array('id'=>$id,'result'=>'ok');
            }
        }
        return $result;
    }

    /**
     * @throws ArgumentException
     */
    private function setPosition($arguments): array
    {
        $fields = $arguments['fields'];
        if (!is_array($fields)) {
            throw new ArgumentException();
        }

        $result = [];
        foreach ($fields  as $field) {
            $id     = $field['ID'];
            $name   = $field['NAME'];

            $res = @pg_query_params($this->pg, 'insert into positions (id,  name ) values ($1,$2) on conflict ON CONSTRAINT positions_pk do update set name =$2', [$id,$name]);
            if ($res === false) {
                $result[] = array('id' => $id, 'result' => 'error', 'message' => @pg_last_error($this->pg));
            }
            else {
                $result[] = array('id'=>$id,'result'=>'ok');
            }
        }
        return $result;
    }


    /**
     * @throws ArgumentException
     * @throws Exception
     */
    private function setPersonalType($arguments): array
    {
        $fields = $arguments['fields'];
        if (!is_array($fields)) {
            throw new ArgumentException();
        }

        //$html_utf8 = mb_convert_encoding($html, "utf-8", "windows-1251");

        $result = [];
        foreach ($fields  as $field) {
            $id     = $field['ID'];
            $name   = $field['NAME'];
            $active = $field['ACTIVE'] === 'Y' ? 't' : 'f';

            $res = @pg_query_params($this->pg, 'insert into personal_types (id, active, name ) values ($1,$2,$3) on conflict ON CONSTRAINT personal_types_pk do update set active=$2, name =$3', [$id,$active,$name]);
            if ($res === false) {
                $result[] = array('id' => $id, 'result' => 'error', 'message' => @pg_last_error($this->pg));
            }
            else {
                $result[] = array('id'=>$id,'result'=>'ok');
            }
        }
        return $result;
    }

    /**
     * @throws ArgumentException
     * @throws Exception
     */
    private function setDepartment($arguments): array
    {
        $fields = $arguments['fields'];
        if (!is_array($fields)) {
            throw new ArgumentException();
        }

        //$html_utf8 = mb_convert_encoding($html, "utf-8", "windows-1251");

        $result = [];
        foreach ($fields  as $field) {
            $id     = $field['ID'];
            $name   = $field['NAME'];
            $active = $field['ACTIVE'] === 'Y' ? 't' : 'f';

            $parent_id       = null_val($field['PARENT_ID']);
            $organization_id = null_val($field['ORGANIZATION_ID']);
            $header          = null_val($field['HEADER']);


            $res = @pg_query_params($this->pg, 'insert into departments (id, active, name, parent_id, organization_id, header ) values ($1,$2,$3,$4,$5,$6) on conflict ON CONSTRAINT departments_pk do update set active=$2, name=$3, parent_id=$4, organization_id=$5, header=$6 ', [$id,$active,$name, $parent_id, $organization_id, $header]);
            if ($res === false) {
                $result[] = array('id' => $id, 'result' => 'error', 'message' => @pg_last_error($this->pg));
            }
            else {
                $result[] = array('id'=>$id,'result'=>'ok');
            }
        }
        return $result;
    }

    /**
     * @throws ArgumentException
     * @throws Exception
     */
    private function setPersonalDirections($arguments): array
    {
        $fields = $arguments['fields'];
        if (!is_array($fields)) {
            throw new ArgumentException();
        }

        //$html_utf8 = mb_convert_encoding($html, "utf-8", "windows-1251");

        $result = [];
        foreach ($fields  as $field) {
            $id     = $field['ID'];
            $name   = $field['NAME'];
            $active = $field['ACTIVE'] === 'Y' ? 't' : 'f';

            $header = null_val($field['HEADER']);
            $sort   = $field['SORT'];


            $res = @pg_query_params($this->pg, 'insert into personal_directions (id, active, name, header,sort ) values ($1,$2,$3,$4,$5) on conflict ON CONSTRAINT personal_directions_pk do update set active=$2, name=$3,  header=$4, sort=$5 ', [$id,$active,$name, $header, $sort]);
            if ($res === false) {
                $result[] = array('id' => $id, 'result' => 'error', 'message' => @pg_last_error($this->pg));
            }
            else {
                $result[] = array('id'=>$id,'result'=>'ok');
            }
        }
        return $result;
    }


    /**
     * @throws ArgumentException
     * @throws Exception
     */
    private function setUser($arguments): array
    {
        $fields = $arguments['fields'];
        if (!is_array($fields)) {
            throw new ArgumentException();
        }

        //$html_utf8 = mb_convert_encoding($html, "utf-8", "windows-1251");

        $result = [];
        foreach ($fields  as $field) {
            $portal_id     = $field['PORTAL_ID'];
            $id            = generateUUID();
            $active        = $field['ACTIVE'] === 'Y' ? 't' : 'f';

            $login          = $field['LOGIN'];
            $last           = $field['LAST_NAME'];
            $name           = $field['NAME'];
            $second         = $field['SECOND_NAME'];

            $phone          = $field['PHONE'];
            $email          = $field['EMAIL'];
            $birthday       = $field['BIRTHDAY'];

            $gender           = $field['GENDER'];
            $work_phone       = $field['WORK_PHONE'];
            $uf_phone_inner   = $field['UF_PHONE_INNER'];

            try {
                $res = @pg_query($this->pg,'BEGIN');
                if ($res=== false) { throw new Exception(em('DB-0002','BEGIN: ['.$portal_id .'] '.@pg_last_error($this->pg)));}

                $res = @pg_query_params($this->pg, 'insert into users (id, active, login, last_name, name, second_name, phone, email, birthday, gender, work_phone, uf_phone_inner ) values ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12) on conflict ON CONSTRAINT users_pk do update set active=$2, login=$3, last_name=$4, name=$5, second_name=$6, phone=$7, email=$8, birthday=$9, gender=$10, work_phone=$11, uf_phone_inner=$12 ', [$id, $active, $login, $last, $name, $second, $phone, $email, $birthday, $gender, $work_phone, $uf_phone_inner]);
                if ($res=== false) { throw new Exception(em('DB-0003','INSERT into users: ['.$portal_id .'] '.@pg_last_error($this->pg)));}

                    $res = @pg_query_params($this->pg, ' delete from user_positions where user_id=$1 ', [$id]);
                    if ($res===false) { throw new Exception(em('DB-0003','DELETE from users: ['.$portal_id .'] '.@pg_last_error($this->pg)));}

                    if (is_array($field['UF_DEPARTMENT_AR'])) {
                        foreach ($field['UF_DEPARTMENT_AR'] as $user_position) {

                            $user_position_id = $user_position['ID'];
                            $organization_id  = $user_position['ORGANIZATION_ID'];
                            $department_id    = $user_position['DEPARTMENT'];
                            $position_id      = $user_position['POSITION_ID'];

                            $position_type    = null_val($user_position['TYPE']);
                            $direction        = null_val($user_position['DIRECTION']);
                            $post_type        = null_val($user_position['POST_TYPE']);

                            $res = @pg_query_params($this->pg, 'insert into user_positions (id, user_id, organization_id, department_id, position_id,  position_type, direction, post_type ) values ($1,$2,$3,$4,$5,$6,$7,$8) on conflict ON CONSTRAINT user_positions_pk do update set user_id=$2, organization_id=$3, department_id=$4, position_id=$5,  position_type=$6, direction=$7, post_type=$8 ', [$user_position_id, $id, $organization_id, $department_id, $position_id, $position_type, $direction, $post_type  ]);
                            if ($res=== false) { throw new Exception(em('DB-0003','INSERT into user_positions: ['.$portal_id .' - '.$user_position_id.'] '.@pg_last_error($this->pg)));}

                        }
                    }

                    $res = @pg_query($this->pg,'COMMIT');
                    $result[] = array('id'=>$portal_id,'result'=>'ok');
            }
            catch (Exception $e) {
                @pg_query($this->pg,'ROLLBACK');
                $result[] = array('id' => $portal_id, 'result' => 'error', 'message' => $e->getMessage());
            }

        }
        return $result;
    }


    /**
     * @throws Exception
     */
    function getOrganizationList(): array {
        #---- Get Organisations -----------------
        $result = [];
        $res = @pg_query($this->pg,"Select * from organizations where active=true order by name");
        if ($res !== false) {
            while ($row = @pg_fetch_array($res)) {
                $result[] = [
                    'id' => $row['id'],
                    'name' => $row['name']
                ];
            }
        } else {
            throw new Exception(em('DB-0002','DB Select error: '.pg_last_error($this->pg)));
        }
        return $result;
    }

    function getDepartmentList(): array {
        #---- Get Organisations -----------------
        $result = [];
        $res = @pg_query($this->pg,"Select * from departments where active=true order by name");
        if ($res !== false) {
            while ($row = @pg_fetch_array($res)) {

                if ($row['header']!='') {
                    $dirs = @pg_query($this->pg,"select * from users where id='".$row['header']."'");
                    $dir = @pg_fetch_array($dirs);
                    $row['header'] = $dir;
                }
                $result['header'][$row['id']] = [
                    'id' => $row['id'],
                    'header' => $row['header']
                ];
                $result[] = [
                    'id' => $row['id'],
                    'name' => $row['name']
                ];
            }
        } else {
            throw new Exception(em('DB-0002','DB Select error: '.pg_last_error($this->pg)));
        }
        return $result;
    }
    /**
     * @throws Exception
     */
    function getPersonalTypesList(): array {
        #---- Get Organisations -----------------
        $result = [];
        $res = @pg_query($this->pg,"Select * from personal_types  where active=true order by name");
        if ($res !== false) {
            while ($row = @pg_fetch_array($res)) {
                $result[] = [
                    'id' => $row['id'],
                    'name' => $row['name']
                ];
            }
        } else {
            throw new Exception(em('DB-0002','DB Select error: '.pg_last_error($this->pg)));
        }
        return $result;
    }


    /**
     * @throws Exception
     */
    function getPersonalDirectionsList(): array {
        #---- Get Organisations -----------------
        $result = [];
        $res = @pg_query($this->pg,"Select * from personal_directions  where active=true order by name");
        if ($res !== false) {
            while ($row = @pg_fetch_array($res)) {

                if ($row['header']!='') {
                    $dirs = @pg_query($this->pg,"select * from users where id='".$row['header']."'");
                    $dir = @pg_fetch_array($dirs);
                    $row['header'] = $dir;
                }
                $result[] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'header' => $row['header']
                ];
            }
        } else {
            throw new Exception(em('DB-0002','DB Select error: '.pg_last_error($this->pg)));
        }
        return $result;
    }


    /**
     * @throws Exception
     */
    function getUsersList($arg): array {
        #---- Get Organisations -----------------
        $limit = " limit 9";
        if (isset($arg['paging'])) {
            $offset = intval($arg['paging'])*9;
            $limit = " limit 9 offset ".$offset;
        }
        $result = [];
        $res = @pg_query($this->pg,"select COUNT(users.id) OVER (),user_positions.post_type, users.id,users.active,users.name,last_name,second_name,birthday, departments.name as dep_name,positions.name as post_name, personal_types.name as pos_name, user_positions.direction as der_name, organizations.name as org_name,phone,email FROM users JOIN user_positions ON user_positions.user_id=users.id JOIN departments ON departments.id=user_positions.department_id JOIN personal_types ON user_positions.position_type=personal_types.id JOIN positions ON user_positions.position_id=positions.id JOIN organizations ON user_positions.organization_id=organizations.id where users.active=true and user_positions.post_type='M' ORDER by users.last_name".$limit);
        $res_count = @pg_query($this->pg,"SELECT count(*)   FROM user_positions where post_type='M'");
        $count_list = @pg_fetch_array($res_count)['count'];
        $count = 0;
        if ($res !== false) {
            while ($row = @pg_fetch_array($res)) {
                if ($row['der_name']!='') {
                    $dirs = @pg_query($this->pg,"select name from personal_directions where id='".$row['der_name']."'");
                    $dir = @pg_fetch_array($dirs);
                    $row['der_name'] = $dir['name'];
                }
                $count = $row['count'];
                $result['list'][] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'last_name' => $row['last_name'],
                    'second_name' => $row['second_name'],
                    'birthday' => $row['birthday'],
                    'phone' => $row['phone'],
                    'email' => $row['email'],
                    'birthday' => $row['birthday'],
                    'pos_name' => $row['pos_name'],
                    'dep_name' => $row['dep_name'],
                    'der_name' => $row['der_name'],
                    'post_name' => $row['post_name'],
                    'org_name' => $row['org_name']
                ];
            }
        } else {
            throw new Exception(em('DB-0002','DB Select error: '.pg_last_error($this->pg)));
        }
         $result['count'] = $count;
         $result['count_list'] = $count_list;
         return $result;
    }


    /**
     * @throws Exception
     */
    function getUsersSearch($argument): array {
        #---- Get Organisations -----------------

        $limit = " limit 9";
        if (isset($argument['paging'])) {
            $offset = intval($argument['paging'])*9;
            $limit = " limit 9 offset ".$offset;
        }
        $where = '';
        $where_text = "";

        
        if (isset($argument['list'])) {
            $type=$argument['type'];
            $where = "and (user_positions.".$type."='asd'";

            foreach ($argument['list'] as $value) {
               $where =$where. " or user_positions.".$type."='".$value['id']."'";
            }

            $where1=$where.")";

            $where = str_replace("user_positions.".$type."='asd' or ", ' ', $where1);
        }
        if (isset($argument['fields']) and $argument['type']!='department_id') {
            foreach ($argument['fields'] as $field => $value) {
               $where = " and user_positions.".$field."='".$value."'";
        }
        }if (isset($argument['text'])) {
            $arg_text = mb_strtolower($argument['text']);
            $where_text = "(LOWER(users.name) LIKE '%".$arg_text."%' OR LOWER(users.last_name) LIKE '%".$arg_text."%' OR LOWER(users.phone) LIKE '%".$arg_text."%' OR LOWER(users.email) LIKE '%".$arg_text."%' OR LOWER(users.second_name) LIKE '%".$arg_text."%' OR LOWER(departments.name) LIKE '%".$arg_text."%' OR LOWER(personal_types.name) LIKE '%".$arg_text."%' OR LOWER(positions.name) LIKE '%".$arg_text."%' OR LOWER(organizations.name) LIKE '%".$arg_text."%') and";
        }
        $result = [];
        $res = @pg_query($this->pg,"select * from(select DISTINCT ON (users.id) COUNT(users.id) OVER (), users.id,users.active,users.name,last_name,second_name,birthday, departments.name as dep_name,positions.name as post_name, user_positions.post_type as corppo_type, personal_types.name as pos_name, user_positions.direction as der_name, organizations.name as org_name,phone,email FROM users JOIN user_positions ON user_positions.user_id=users.id JOIN departments ON departments.id=user_positions.department_id JOIN personal_types ON user_positions.position_type=personal_types.id JOIN positions ON user_positions.position_id=positions.id JOIN organizations ON user_positions.organization_id=organizations.id where ".$where_text." users.active=true ".$where.") sub ORDER by last_name".$limit);

        $count_req = @pg_query($this->pg,"select COUNT(users.id) from users JOIN user_positions ON user_positions.user_id=users.id JOIN departments ON departments.id=user_positions.department_id JOIN personal_types ON user_positions.position_type=personal_types.id JOIN positions ON user_positions.position_id=positions.id JOIN organizations ON user_positions.organization_id=organizations.id where ".$where_text." users.active=true ".$where." and user_positions.post_type='M'");
        if ($argument['type']=='organization_id') {
            $count = $this->countWorkser($argument['fields'][$argument['type']],'organization_id');
        }
        else if ($argument['type']=='department_id') {
            $count = $this->countWorkser($argument['fields'][$argument['type']]);
        }else{
            $count = @pg_fetch_array($count_req)['count'];
        }

        if ($res !== false) {
            while ($row = @pg_fetch_array($res)) {
                if ($row['corppo_type']=='M') {
                    if ($row['der_name']!='') {
                        $dirs = @pg_query($this->pg,"select name from personal_directions where id='".$row['der_name']."'");
                        $dir = @pg_fetch_array($dirs);
                        $row['der_name'] = $dir['name'];
                    }
                    $restl = [
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'last_name' => $row['last_name'],
                        'second_name' => $row['second_name'],
                        'birthday' => $row['birthday'],
                        'phone' => $row['phone'],
                        'email' => $row['email'],
                        'birthday' => $row['birthday'],
                        'pos_name' => $row['pos_name'],
                        'dep_name' => $row['dep_name'],
                        'der_name' => $row['der_name'],
                        'post_name' => $row['post_name'],
                        'org_name' => $row['org_name']
                    ];
                    $result['list'][] = $restl;
                }else{
                    $ressts = @pg_query($this->pg,"select COUNT(users.id) OVER (), users.id,users.active,users.name,last_name,second_name,birthday, departments.name as dep_name,positions.name as post_name, user_positions.post_type as corppo_type, personal_types.name as pos_name, user_positions.direction as der_name, organizations.name as org_name,phone,email FROM users JOIN user_positions ON user_positions.user_id=users.id JOIN departments ON departments.id=user_positions.department_id JOIN personal_types ON user_positions.position_type=personal_types.id JOIN positions ON user_positions.position_id=positions.id JOIN organizations ON user_positions.organization_id=organizations.id where user_positions.post_type='M' and users.id='".$row['id']."'");
                    $rowSuser = @pg_fetch_array($ressts);
                    if ($rowSuser['der_name']!='') {
                        $dirs = @pg_query($this->pg,"select name from personal_directions where id='".$rowSuser['der_name']."'");
                        $dir = @pg_fetch_array($dirs);
                        $rowSuser['der_name'] = $dir['name'];
                    }
                    $rest1 = [
                        'id' => $rowSuser['id'],
                        'name' => $rowSuser['name'],
                        'last_name' => $rowSuser['last_name'],
                        'second_name' => $rowSuser['second_name'],
                        'birthday' => $rowSuser['birthday'],
                        'phone' => $rowSuser['phone'],
                        'email' => $rowSuser['email'],
                        'birthday' => $rowSuser['birthday'],
                        'pos_name' => $rowSuser['pos_name'],
                        'dep_name' => $rowSuser['dep_name'],
                        'der_name' => $rowSuser['der_name'],
                        'post_name' => $rowSuser['post_name'],
                        'org_name' => $rowSuser['org_name']
                    ];
                    $result['list'][] = $rest1;
                }
            }
        } else {
            throw new Exception(em('DB-0002','DB Select error: '.pg_last_error($this->pg)));
        }
        $result['sql'] = "select COUNT(users.id) from users JOIN user_positions ON user_positions.user_id=users.id JOIN departments ON departments.id=user_positions.department_id JOIN personal_types ON user_positions.position_type=personal_types.id JOIN positions ON user_positions.position_id=positions.id JOIN organizations ON user_positions.organization_id=organizations.id where ".$where_text." users.active=true and user_positions.post_type='M' ".$where;
        $result['count'] = $count;
        $result['count_list'] = $count;
        return $result;
    }


    /**
     * @throws Exception
     */
    function getUsersSearchMain($argument): array {
        #---- Get Organisations -----------------

        $limit = " limit 9";
        if (isset($argument['paging'])) {
            $offset = intval($argument['paging'])*9;
            $limit = " limit 9 offset ".$offset;
        }
        $where = '';
        $where_text = '';
        if (isset($argument['text'])) {
            $arg_text = mb_strtolower($argument['text']);
            $where_text = "(LOWER(users.name) LIKE '%".$arg_text."%' OR LOWER(users.last_name) LIKE '%".$arg_text."%' OR LOWER(users.phone) LIKE '%".$arg_text."%' OR LOWER(users.email) LIKE '%".$arg_text."%' OR LOWER(users.second_name) LIKE '%".$arg_text."%' OR LOWER(departments.name) LIKE '%".$arg_text."%' OR LOWER(personal_types.name) LIKE '%".$arg_text."%' OR LOWER(positions.name) LIKE '%".$arg_text."%' OR LOWER(organizations.name) LIKE '%".$arg_text."%') and";
        }
        $result = [];
        $res = @pg_query($this->pg,"select * from(select DISTINCT ON (users.id) COUNT(users.id) OVER (), users.id,users.active,users.name,last_name,second_name,birthday, departments.name as dep_name,positions.name as post_name, user_positions.post_type as corppo_type, personal_types.name as pos_name, user_positions.direction as der_name, organizations.name as org_name,phone,email FROM users JOIN user_positions ON user_positions.user_id=users.id JOIN departments ON departments.id=user_positions.department_id JOIN personal_types ON user_positions.position_type=personal_types.id JOIN positions ON user_positions.position_id=positions.id JOIN organizations ON user_positions.organization_id=organizations.id where ".$where_text." users.active=true ".$where.") sub ORDER by last_name".$limit);
        $count_req = @pg_query($this->pg,"select COUNT(users.id) from users JOIN user_positions ON user_positions.user_id=users.id JOIN departments ON departments.id=user_positions.department_id JOIN personal_types ON user_positions.position_type=personal_types.id JOIN positions ON user_positions.position_id=positions.id JOIN organizations ON user_positions.organization_id=organizations.id where ".$where_text." users.active=true and user_positions.post_type='M' ".$where);
        $count = @pg_fetch_array($count_req)['count'];
        if ($res !== false) {
            while ($row = @pg_fetch_array($res)) {
                if ($row['corppo_type']=='M') {
                    if ($row['der_name']!='') {
                        $dirs = @pg_query($this->pg,"select name from personal_directions where id='".$row['der_name']."'");
                        $dir = @pg_fetch_array($dirs);
                        $row['der_name'] = $dir['name'];
                    }
                    $restl = [
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'last_name' => $row['last_name'],
                        'second_name' => $row['second_name'],
                        'birthday' => $row['birthday'],
                        'phone' => $row['phone'],
                        'email' => $row['email'],
                        'birthday' => $row['birthday'],
                        'pos_name' => $row['pos_name'],
                        'dep_name' => $row['dep_name'],
                        'der_name' => $row['der_name'],
                        'post_name' => $row['post_name'],
                        'org_name' => $row['org_name']
                    ];
                    $result['list'][] = $restl;
                }else{
                    $ressts = @pg_query($this->pg,"select COUNT(users.id) OVER (), users.id,users.active,users.name,last_name,second_name,birthday, departments.name as dep_name,positions.name as post_name, user_positions.post_type as corppo_type, personal_types.name as pos_name, user_positions.direction as der_name, organizations.name as org_name,phone,email FROM users JOIN user_positions ON user_positions.user_id=users.id JOIN departments ON departments.id=user_positions.department_id JOIN personal_types ON user_positions.position_type=personal_types.id JOIN positions ON user_positions.position_id=positions.id JOIN organizations ON user_positions.organization_id=organizations.id where user_positions.post_type='M' and users.id='".$row['id']."'");
                    $rowSuser = @pg_fetch_array($ressts);
                    if ($rowSuser['der_name']!='') {
                        $dirs = @pg_query($this->pg,"select name from personal_directions where id='".$rowSuser['der_name']."'");
                        $dir = @pg_fetch_array($dirs);
                        $rowSuser['der_name'] = $dir['name'];
                    }
                    $rest1 = [
                        'id' => $rowSuser['id'],
                        'name' => $rowSuser['name'],
                        'last_name' => $rowSuser['last_name'],
                        'second_name' => $rowSuser['second_name'],
                        'birthday' => $rowSuser['birthday'],
                        'phone' => $rowSuser['phone'],
                        'email' => $rowSuser['email'],
                        'birthday' => $rowSuser['birthday'],
                        'pos_name' => $rowSuser['pos_name'],
                        'dep_name' => $rowSuser['dep_name'],
                        'der_name' => $rowSuser['der_name'],
                        'post_name' => $rowSuser['post_name'],
                        'org_name' => $rowSuser['org_name']
                    ];
                    $result['list'][] = $rest1;
                }
            }
        } else {
            throw new Exception(em('DB-0002','DB Select error: '.pg_last_error($this->pg)));
        }
         $result['count_list'] = $count;
         $result['count'] = $count;
         return $result;
    }
    function getUsersById($argument){
        $id=$argument['id'];
        $res = @pg_query($this->pg,"select COUNT(users.id) OVER (), users.id,users.photo,users.active,users.name,last_name,second_name,birthday, departments.name as dep_name,positions.name as post_name, personal_types.name as pos_name, user_positions.post_type as corppo_type, user_positions.direction as der_name,  user_positions.department_id as header_id,organizations.name as org_name,phone,email FROM users JOIN user_positions ON user_positions.user_id=users.id JOIN departments ON departments.id=user_positions.department_id JOIN personal_types ON user_positions.position_type=personal_types.id JOIN positions ON user_positions.position_id=positions.id JOIN organizations ON user_positions.organization_id=organizations.id where users.active=true and users.id='".$id."'");
        $count = 0;
        if ($res !== false) {
            while ($row = @pg_fetch_array($res)) {
                if ($row['der_name']!='') {
                    $dirs = @pg_query($this->pg,"select name,header from personal_directions where id='".$row['der_name']."'");
                    $dir = @pg_fetch_array($dirs);
                    $row['der_name'] = $dir['name'];
                    if ($dir['header']!='') {
                        $dirs = @pg_query($this->pg,"select id,name,last_name,second_name from users where id='".$dir['header']."'");
                        $row['der_header'] = @pg_fetch_array($dirs);
                    }
                }
                if ($row['header_id']!='') {
                    $dirs = @pg_query($this->pg,"select name,header,parent_id from departments where id='".$row['header_id']."'");
                    $dir = @pg_fetch_array($dirs);
                    if ($dir['header']!='') {
                        if ($row['id']==$dir['header']) {
                            $dirs_parent = @pg_query($this->pg,"select name,header,parent_id from departments where id='".$dir['parent_id']."'");
                            $dir_parent = @pg_fetch_array($dirs_parent);
                            if ($dir_parent['header']!='') {
                                $dirs = @pg_query($this->pg,"select id,name,last_name,second_name from users where id='".$dir_parent['header']."'");
                                $row['header'] = @pg_fetch_array($dirs);
                            }
                        }else{
                            $dirs = @pg_query($this->pg,"select id,name,last_name,second_name from users where id='".$dir['header']."'");
                            $row['header'] = @pg_fetch_array($dirs);
                            $row['header']['parent_id'] = $dir['parent_id'];
                        }
                    }else{
                        $row['header'] = $row['id'].''.$dir['header'];
                    }
                }
                $count = $row['count'];
                $restl = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'last_name' => $row['last_name'],
                    'second_name' => $row['second_name'],
                    'birthday' => $row['birthday'],
                    'phone' => $row['phone'],
                    'email' => $row['email'],
                    'birthday' => $row['birthday'],
                    'pos_name' => $row['pos_name'],
                    'dep_name' => $row['dep_name'],
                    'der_name' => $row['der_name'],
                    'der_header' => $row['der_header'],
                    'post_name' => $row['post_name'],
                    'corppo_type' => $row['corppo_type'],
                    'header' => $row['header'],
                    'photo' => $row['photo'],
                    'org_name' => $row['org_name']
                ];
                $result['list'][] = $restl;
            }
        } else {
            throw new Exception(em('DB-0002','DB Select error: '.pg_last_error($this->pg)));
        }
         $result['sql'] = "select COUNT(users.id) OVER (), users.id,users.photo,users.active,users.name,last_name,second_name,birthday, departments.name as dep_name,positions.name as post_name, personal_types.name as pos_name, user_positions.post_type as corppo_type, user_positions.direction as der_name,  user_positions.department_id as header_id,organizations.name as org_name,phone,email FROM users JOIN user_positions ON user_positions.user_id=users.id JOIN departments ON departments.id=user_positions.department_id JOIN personal_types ON user_positions.position_type=personal_types.id JOIN positions ON user_positions.position_id=positions.id JOIN organizations ON user_positions.organization_id=organizations.id where users.active=true and users.id='".$id."'";
         $result['count'] = $count;
         return $result;
    }

    function getUsersByTyped($argument){
        $type=$argument['type'];
        $where = "(user_positions.".$type."='asd'";
        if (isset($argument['list'])) {
            foreach ($argument['list'] as $value) {
               $where =$where. " or user_positions.".$type."='".$value['id']."'";
            }
        }
        $where1=$where.")";

        $where = str_replace("user_positions.".$type."='asd' or ", ' ', $where1);


        $limit = " limit 9";
        if (isset($argument['paging'])) {
            $offset = intval($argument['paging'])*9;
            $limit = " limit 9 offset ".$offset;
        }
        $where_text = " user_positions.post_type='M' and";
        if (isset($argument['text'])) {
            $where_text='';
            $arg_text = mb_strtolower($argument['text']);
            $where_text = "(LOWER(users.name) LIKE '%".$arg_text."%' OR LOWER(users.last_name) LIKE '%".$arg_text."%' OR LOWER(users.phone) LIKE '%".$arg_text."%' OR LOWER(users.email) LIKE '%".$arg_text."%' OR LOWER(users.second_name) LIKE '%".$arg_text."%' OR LOWER(departments.name) LIKE '%".$arg_text."%' OR LOWER(personal_types.name) LIKE '%".$arg_text."%' OR LOWER(positions.name) LIKE '%".$arg_text."%' OR LOWER(organizations.name) LIKE '%".$arg_text."%') and";
        }


        $res = @pg_query($this->pg,"select COUNT(users.id) OVER (), users.id,users.active,users.name,last_name,second_name,birthday, departments.name as dep_name, departments.id as dep_id,positions.name as post_name, personal_types.name as pos_name, user_positions.post_type as corppo_type, user_positions.direction as der_name, organizations.name as org_name,phone,email FROM users JOIN user_positions ON user_positions.user_id=users.id JOIN departments ON departments.id=user_positions.department_id JOIN personal_types ON user_positions.position_type=personal_types.id JOIN positions ON user_positions.position_id=positions.id JOIN organizations ON user_positions.organization_id=organizations.id where ".$where_text." users.active=true and ".$where." ORDER by users.last_name".$limit);
        $res_count = @pg_query($this->pg,"SELECT count(*) FROM user_positions where post_type='M'");
        $count_list = @pg_fetch_array($res_count)['count'];
        $count = 0;
        if ($res !== false) {
            while ($row = @pg_fetch_array($res)) {
                if ($row['der_name']!='') {
                    $dirs = @pg_query($this->pg,"select name from personal_directions where id='".$row['der_name']."'");
                    $dir = @pg_fetch_array($dirs);
                    $row['der_name'] = $dir['name'];
                }
                $count = $row['count'];
                $restl = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'last_name' => $row['last_name'],
                    'second_name' => $row['second_name'],
                    'birthday' => $row['birthday'],
                    'phone' => $row['phone'],
                    'email' => $row['email'],
                    'birthday' => $row['birthday'],
                    'pos_name' => $row['pos_name'],
                    'dep_name' => $row['dep_name'],
                    'der_name' => $row['der_name'],
                    'post_name' => $row['post_name'],
                    'corppo_type' => $row['corppo_type'],
                    'org_name' => $row['org_name']
                ];
                $result['list'][] = $restl;
            }
        } else {
            throw new Exception(em('DB-0002','DB Select error: '.pg_last_error($this->pg)));
        }
        $result['sql'] = "SELECT count(*) FROM user_positions where post_type='M'";
        $result['count_list'] = $count_list;
        $result['count'] = $count;
        return $result;
    }
    function getPods($argument){
        $type = $argument['type'];
        $res = @pg_query($this->pg,"SELECT `".$type."`, COUNT(*) FROM users JOIN user_positions ON user_positions.user_id=users.id WHERE users.active=true and user_positions.post_type='M' GROUP BY `".$type."`");
        if ($res !== false) {
            while ($row = @pg_fetch_array($res)) {
                $count = $row['count'];
                $restl = [
                    'count' => $row['count'],
                ];
                if ($type =='organization_id') {
                    $header = @pg_query($this->pg,"SELECT * FROM public.departments where organization_id='".$row[$type]."' and parent_id is null order by sort");
                    $header_id = @pg_fetch_array($header);
                    $user_header = @pg_query($this->pg,"SELECT * FROM public.users where id='".$header_id['header']."'");
                    $restl['header'] = @pg_fetch_array($user_header);
                    $restl['count'] = $this->countWorkser($row['organization_id'],'organization_id');
                }
                $result['list'][$row[$type]] = $restl;
            }
        } else {
            throw new Exception(em('DB-0002','DB Select error: '.pg_last_error($this->pg)));
        }
    return $result;
    }
    function getOrgtyped($argument){
        if (isset($argument['id'])) {
            $id = $argument['id'];
        }
        $where_text = ' and parent_id is null';
        $parent_type = 'organization_id';
        $subtypes = 'organizations';
        if (isset($argument['parentid'])) {
            $subtypes = 'departments';
            $where_text = '';
            $parent_type = 'parent_id';
            $id = $argument['parentid'];
        }
        $res = @pg_query($this->pg,"SELECT COUNT(departments.id) OVER (), * FROM departments where ".$parent_type."='".$id."'".$where_text." order by sort");
        $result = array();
        if (@pg_num_rows($res)==0) {
            $where_text = '';
            $res = @pg_query($this->pg,"SELECT  * FROM departments where ".$parent_type."='".$id."'".$where_text."");
            if ($res !== false) {
                while ($row = @pg_fetch_array($res)) {
                    $test_req = @pg_query($this->pg,"SELECT * FROM departments where parent_id='".$row['id']."'");
                    $header = @pg_query($this->pg,"SELECT id,last_name,second_name,name FROM users where id='".$row['header']."'");
                    $header_arr = @pg_fetch_array($header);
                    $count = $this->countWorkser($row['id']);
                    $type = 'child';
                    if (@pg_num_rows($test_req)!=0) {
                        $type = 'parent';
                    }
                    $reslt= [
                        'count' => $count,
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'type' => $type
                    ];
                    if (isset($header_arr['id'])) {
                        $reslt['header_id'] = $header_arr['id'];
                        $reslt['header_name'] = $header_arr['last_name'].' '. mb_substr($header_arr['name'], 0, 1).'.'.mb_substr($header_arr['second_name'], 0, 1);
                    }
                    $result['list'][] = $reslt;
                }
            } else {
                throw new Exception(em('DB-0002','DB Select error: '.pg_last_error($this->pg)));
            }
        }else{
            if ($res !== false) {
                while ($row = @pg_fetch_array($res)) {
                    $test_req = @pg_query($this->pg,"SELECT * FROM departments where parent_id='".$row['id']."'");
                    $header = @pg_query($this->pg,"SELECT id,last_name,second_name,name FROM users where id='".$row['header']."'");
                    $header_arr = @pg_fetch_array($header);
                    $count = $this->countWorkser($row['id']);
                    $type = 'child';
                    if (@pg_num_rows($test_req)!=0) {
                        $type = 'parent';
                    }
                    $reslt= [
                        'count' => $count,
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'type' => $type
                    ];
                    if (isset($header_arr['id'])) {
                        $reslt['header_id'] = $header_arr['id'];
                        $reslt['header_name'] = $header_arr['last_name'].' '. mb_substr($header_arr['name'], 0, 1).'.'.mb_substr($header_arr['second_name'], 0, 1);
                    }
                    $result['list'][] = $reslt;
                }
            } else {
                throw new Exception(em('DB-0002','DB Select error: '.pg_last_error($this->pg)));
            }

        }
        $subtitlereq = @pg_query($this->pg,"SELECT * FROM ".$subtypes." where id='".$id."'");
        $subtitle = @pg_fetch_array($subtitlereq)['name'];
        $result['title'] = $subtitle;
    return $result;
    }
    function countWorkser($job,$type=null){
        $id = $job;
        $searcher = 'parent_id';
        $null = '';
        if ($type=='organization_id') {
            $searcher=$type;
            $null=' and parent_id is null';
        }
        $res = @pg_query($this->pg,"SELECT  * FROM departments where ".$searcher."='".$id."'".$null);
        $count = 0;
        if ($res !== false) {
            if (@pg_num_rows($res)!=0) {
                while ($row = @pg_fetch_array($res)) {
                    $jobs = @pg_query($this->pg,"SELECT * FROM departments where parent_id ='".$row['id']."'");
                    if (@pg_num_rows($jobs)!=0) {
                        $count = $count+$this->countWorkser($row['id']);
                    }else{
                        $counts_users = @pg_query($this->pg,"SELECT COUNT(*) FROM user_positions where department_id='".$row['id']."' ");
                        $count = $count+@pg_fetch_array($counts_users)['count'];
                    }
                }
            }else{
                if ($type=='organization_id') {
                    $res = @pg_query($this->pg,"SELECT  * FROM departments where ".$searcher."='".$id."'");
                    while ($row = @pg_fetch_array($res)) {
                        $jobs = @pg_query($this->pg,"SELECT * FROM departments where parent_id ='".$row['id']."'");
                        if (@pg_num_rows($jobs)!=0) {
                            $count = $count+$this->countWorkser($row['id']);
                        }else{
                            $counts_users = @pg_query($this->pg,"SELECT COUNT(*) FROM user_positions where department_id='".$row['id']."' ");
                            $count = $count+@pg_fetch_array($counts_users)['count'];
                        }
                    }
                }else{
                    $counts_users = @pg_query($this->pg,"SELECT COUNT(*) FROM user_positions where department_id='".$id."' ");
                    $count = @pg_fetch_array($counts_users)['count'];
                }
            }
        }
    return $count;
    }
    function getDepList($job){

        $id = $job;
        $res = @pg_query($this->pg,"SELECT  * FROM departments where parent_id ='".$id."'");
        $count = 0;
        $array_dep = array();
        if ($res !== false) {
            if (@pg_num_rows($res)!=0) {
                while ($row = @pg_fetch_array($res)) {
                    $jobs = @pg_query($this->pg,"SELECT  * FROM departments where parent_id ='".$row['id']."'");
                    if (@pg_num_rows($jobs)!=0) {
                        $array_dep = array_merge($array_dep,$this->getDepList($row['id']));
                    }else{
                        $array_dep[]['id'] = $row['id'];
                    }
                }
            }else{
               $array_dep[]['id'] = $id;
            }
        }
        return $array_dep;
    }
}

