<?PHP

/*
$ch = new ConsistentHashing;

$ch->add("13");
$ch->add("10");
$ch->add("11");
$ch->add("12");
//$ch->add("6");
//$ch->add("4");
//$ch->add("2");
//$ch->add("0");

//$ch->delete("12");
echo "Points:<br>\n<pre>"; print_r($ch->points); echo "</pre><br>\n";
echo "Neigh:<br>\n<pre>"; print_r($ch->neighbours("12", 3)); echo "</pre><br>\n";
*/

/**
 * This general class implements Consistent Hashing as described in the paper
 * mentioned in my GSOC application.
 */
class ConsistentHashingCircle // Consistent Hashing Circle class
{
	var $points = array();

	/**
	 * add($id)
	 * 
	 * This function adds a point on the Consistent Hashing circle.
	 * In our context each point is an available mirror. All mirrors
	 * must be added to the circle using this function before the
	 * circle can be used correctly. 
	 *
	 * @param id An md5 hash that uniquely represents a point on the circle
	 * @return true if the point was successfully added, false if it already exists
	 * @see search
	 */
	function add($id)
	{
	
		$pos = $this->search($this->points, $id); // find the position of the id (which is an md5 hash)
		if($pos<0) // id does not exist already
		{	
			$pos = -($pos+1); // find out where we need to place the new element - @see search
			
			if($pos>(sizeof($this->points)-1)) // if we need to add the point at the end of the array,
			{ // expand the array with the new point and return true
				$this->points[]=$id;
				return true;
			}
			
			/*
			 * If we reached this point it means we have to split one point into two. To accomplish this we
			 * take the value from the old point and the new point (id), and create a 2-point array. We
			 * replace the old point with this new 2-point array, increasing the size of the points array
			 * with 1.
			 */
			$new_slice = array($id, $this->points[$pos]);
			array_splice($this->points, $pos, 1, $new_slice);
			return true;
		}
		else // id already exists, no need to add it again
		{
			return false;
		}
	}

	/**
	 * delete($id)
	 * 
	 * This function deletes a point from the Consistent Hashing circle.
	 *
	 * @param id An md5 hash that uniquely represents a point on the circle
	 * @return true if the point was successfully deleted, false if it does not exist
	 * @see search
	 */
	function delete($id)
	{
		$pos = $this->search($this->points, $id);
		if($pos>=0) // if we found the cell we can point it
		{
			/* old way of deleting
			unset($this->points[$pos]);
			$this->points = array_values($this->points);
			return true;
			*/
			array_splice($this->points, $pos, 1, array()); // replace the deleted point with nothing
			return true;
		}
		return false;
	}

	/**
	 * search(&$haystack, $value)
	 * 
	 * A general binary search function which assumes the $haystack is an already
	 * sorted array with consecutive keys that start from 0. The function searches
	 * for $value in the array $haystack. If it finds the value, it returns its position
	 * in the array. If it does not find it, it returns -(pos+1), where pos is the position
	 * where $value should be added to keep the array sorted.
	 *
	 * @param id An md5 hash that uniquely represents a point on the circle
	 * @return true if the point was successfully deleted, false if it does not exist
	 */
	function search(&$haystack, $value)
	{
		$low=0;
		$size=sizeof($haystack);
		$high=$size;
		while($low<$high)
		{
			$mid = intval(($low+$high)/2);
			if($haystack[$mid]<$value)
				$low = $mid+1;
			else
				$high = $mid;
		}
		
		if($low<$size && $haystack[$low]==$value)
			return $low;
		else
			return -($low+1);
	}

	/**
	 * neighbours($id, $how_many)
	 * 
	 * This function returns a number of points on the circle that are close to the $id.
	 * For example, if we have 1 -> 5 -> 7 -> 13 -> 24 -> going back to 1 -> 5 .. as the circle,
	 * neighbours of $id = 6 and $how_many = 3 would return the points 5, 7 and 13, as being
	 * the closest to 6. 6 is between 5 and 7, and we take the point right at the left of 6, and
	 * the following two on the right, to return three points. If $id would be 13 or 22, in both
	 * cases we would return 13, 24 and 1 (since this is a circle we wrap around and begin from 1
	 * when we reach the end). I used numbers for the examples, but the ids stored on the circle
	 * are actually md5 hashes which are sorted.
	 * 
	 *
	 * @param id An md5 hash that uniquely represents a point on the circle
	 * @param how_many How many points close to the id to return
	 * @return a list of points close to the id, or false if $how_many is not valid
	 */
	function neighbours($id, $how_many)
	{
		$neighbours = array(); // this array will store all the neighbours that we find
		$size_points = sizeof($this->points); // we store the number of points on the circle for future reference
	
		 // if we need more neighbours than there are on the circle, or we need a negative number of circles,
		 // we return false
		if($how_many>$size_points || $how_many<1) 
			return false;
		
		$pos = $this->search($this->points, $id); // find the position of the closest point on the circle
		// for this $id
		if($pos<0) // if pos is negative it means the point (id) lies between two other points,
		{ // so we will take the point right at the left to be the first neighbour in the list
			$pos = -($pos+1);
			$pos--;
			if($pos<0) // TODO: check if this is correct
				$pos=0;
		}
		
		$retrieved = 0; // counts how many neighbours we found
		while($retrieved<$how_many) // while the number of found neighbours is less than how many we want, found another neighbour
		{
			$retrieved++; // increment the number of found neighbours
			$neighbours[] = $this->points[$pos]; // add the current point as a neighbour
			$pos++; // advance the pointer to the next neighbour
			$pos = $pos%$size_points; // wrap around if we reached the end of the array (since the array)
			// actually represents a circle with no end
		}
		
		return $neighbours;
	}

	/**
	 * reset()
	 * 
	 * Empties the circle
	 *
	 */
	function reset()
	{
		$this->points = array();
	}

}

?>