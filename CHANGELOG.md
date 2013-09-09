ElementTree Changelog
=====================

*	0.3.3

	*	Removes elements anywhere in the subtree.

*	0.3.2

	*	Added `Element::removeAttribute`.

*	0.3.1

	*	Abstracted querying and creating query objects behind an interface.

*	0.3.0

	*	Changed querying explicit to specification instead of filters.
	*	Querying now returns a list of matching components instead of using
		callbacks.

*	0.2.2

	*	Attributes are included in queries.
	*	FilterBuilder can make use of `allAttributes`.

*	0.2.1

	*	`Element` provides a list of attributes.

*	0.2.0

	*	Text doesn't stringify using htmlentities anymore but uses the raw value.

*	0.1.5

	*	Introduces attributes as objects.
	*	Values of attributes can be singe/double/unquoted when stringified.

*	0.1.4

	*	`HasParentElement` does not need to specify a name to select any parent element.
	*	Created not-filter for inverse of containing filter.

*	0.1.3

	*	Composite specifications now accept a `FilterBuilder` which provides a
		more fluent interface (otherwise they would need a `new` specification).

*	0.1.2

	*	AndSpecification added (combines filters).
	*	HasParent($name) specificationadded.

*	0.1.1

	*	Added filter that searches all `Element` components.

*	0.1.0

	*	Initial release.