import 'package:equatable/equatable.dart';

abstract class WaitRoomFinishEvent extends Equatable {
  const WaitRoomFinishEvent();

  @override
  List<Object?> get props => [];
}

class WaitRoomFinishEventConnected extends WaitRoomFinishEvent {
  final String idroom;
  final String iduser;

  const WaitRoomFinishEventConnected({
    required this.idroom,
    required this.iduser,
  });

  @override
  List<Object?> get props => [idroom, iduser];
}
