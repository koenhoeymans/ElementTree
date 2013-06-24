ElementTree Changelog
=====================

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