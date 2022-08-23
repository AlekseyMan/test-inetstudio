<?php
$array = [
    ["id" => 1, "date" => "12.01.2020", "name" => "test1"],
    ["id" => 2, "date" => "02.05.2020", "name" => "test2"],
    ["id" => 4, "date" => "08.03.2020", "name" => "test4"],
    ["id" => 1, "date" => "22.01.2020", "name" => "test1"],
    ["id" => 2, "date" => "11.11.2020", "name" => "test4"],
    ["id" => 3, "date" => "06.06.2020", "name" => "test3"],
];

/*
 * выделить уникальные записи (убрать дубли) в отдельный массив.
 * в конечном массиве не должно быть элементов с одинаковым id.
 * $key - по какому ключу производить выборку
 */
function unique_multidim_array($array, $key): array
{
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach ($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}
$array = unique_multidim_array($array, "id");

/*
 * отсортировать многомерный массив по ключу (любому)
 * $key - выбранный ключ
 */
function sortByKey($array, $key): array
{
    usort($array, function ($a, $b) use ($key) {
        return strcmp($a[$key], $b[$key]);
    });
    return $array;
}

/*
 * вернуть из массива только элементы, удовлетворяющие внешним условиям (например элементы с определенным id)
 * $key - по какому полю
 * $value - значение поля
 */
function getValuesBy($array, $key, $value): array
{
    return array_filter($array, function ($result) use ($key, $value) {
        return $result[$key] == $value;
    });
}

/*
 * изменить в массиве значения и ключи (использовать name => id в качестве пары ключ => значение)
На выходе:
$array = [
  "test1" => 1,
  "test2" => 2,
  "test4" => 4,
  "test3" => 3
]
 */
function changeKeyAndValues($array, $newKey, $newValue) :array
{
    return array_map(function ($result) use ($newKey, $newValue) {
        return [$result[$newKey] => $result[$newValue]];
    }, $array);
}

/*
 * В базе данных имеется таблица с товарами goods (id INTEGER, name TEXT),
 * таблица с тегами tags (id INTEGER, name TEXT) и таблица связи товаров и
 * тегов goods_tags (tag_id INTEGER, goods_id INTEGER, UNIQUE(tag_id, goods_id)).
 * Выведите id и названия всех товаров, которые имеют все возможные теги в этой базе.
 */
$sql1 = "SELECT tableName.goods.*
        FROM tableName.goods, tags, tableName.goods_tags
        WHERE tableName.goods_tags.goods_id = tableName.goods.id
        AND tableName.goods_tags.tag_id = tableName.tags.id";

/*
 * Выбрать без join-ов и подзапросов все департаменты, в которых есть мужчины, и все они (каждый)
 * поставили высокую оценку (строго выше 5).
 * create table evaluations
 *	(
 *   	respondent_id uuid primary key, -- ID респондента
 *   	department_id uuid,             -- ID департамента
 *   	gender        boolean,          -- true — мужчина, false — женщина
 *    	value         integer	    -- Оценка
 *	);
 */
$sql2 = "SELECT tableName.evaluations.department_id
	FROM tableName.evaluations
	WHERE tableName.evaluations.gender IS TRUE
	AND tableName.evaluations.value > 5 AND  tableName.evaluations.department_id 
	NOT IN 
	(SELECT tableName.evaluations.department_id
	FROM tableName.evaluations
	WHERE (tableName.evaluations.gender IS TRUE
	AND tableName.evaluations.value < 6) OR tableName.evaluations.gender IS NOT TRUE)";
	
	
	
	
	
	
	


