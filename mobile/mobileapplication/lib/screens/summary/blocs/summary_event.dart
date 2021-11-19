import 'package:equatable/equatable.dart';

abstract class SummaryEvent extends Equatable {
  const SummaryEvent();

  @override
  List<Object?> get props => [];
}

class SummaryEventRequested extends SummaryEvent {
  final String idroom;
  final String iduser;

  const SummaryEventRequested({
    required this.idroom,
    required this.iduser,
  });

  @override
  List<Object?> get props => [idroom, iduser];
}
